<?php

/**
 * CKFinder
 * ========
 * http://ckfinder.com
 * Copyright (C) 2007-2009, CKSource - Frederico Knabben. All rights reserved.
 *
 * The software, this file and its contents are subject to the CKFinder
 * License. Please read the license.txt file before using, installing, copying,
 * modifying or distribute this file or part of its contents. The contents of
 * this file is part of the Source Code of CKFinder.
 */
/**
 * @package CKFinder
 * @subpackage CommandHandlers
 * @copyright CKSource - Frederico Knabben
 */

/**
 * Handle FileUpload command
 *
 * @package CKFinder
 * @subpackage CommandHandlers
 * @copyright CKSource - Frederico Knabben
 */
class CKFinder_Connector_CommandHandler_FileUpload extends CKFinder_Connector_CommandHandler_CommandHandlerBase {

    /**
     * Command name
     *
     * @access protected
     * @var string
     */
    protected $command = "FileUpload";

    /**
     * send response (save uploaded file, resize if required)
     * @access public
     *
     */
    public function sendResponse() {
        $iErrorNumber = CKFINDER_CONNECTOR_ERROR_NONE;

        $oRegistry = & CKFinder_Connector_Core_Factory::getInstance("Core_Registry");
        $oRegistry->set("FileUpload_fileName", "unknown file");

        $uploadedFile = array_shift($_FILES);

        if (!isset($uploadedFile['name'])) {
            $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_UPLOADED_INVALID);
        }

        $sFileName = CKFinder_Connector_Utils_FileSystem::convertToFilesystemEncoding(CKFinder_Connector_Utils_Misc::mbBasename($uploadedFile['name']));
        $yuandot = pathinfo($sFileName);
        $sFileName = md5((string) time() . $yuandot['dirname']) . '.' . strtolower($yuandot['extension']);
        $oRegistry->set("FileUpload_fileName", $sFileName);

        $this->checkConnector();
        $this->checkRequest();

        $_config = & CKFinder_Connector_Core_Factory::getInstance("Core_Config");
        if (!$this->_currentFolder->checkAcl(CKFINDER_CONNECTOR_ACL_FILE_UPLOAD)) {
            $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_UNAUTHORIZED);
        }

        $_resourceTypeConfig = $this->_currentFolder->getResourceTypeConfig();
        if (!CKFinder_Connector_Utils_FileSystem::checkFileName($sFileName) || $_resourceTypeConfig->checkIsHiddenFile($sFileName)) {
            $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_INVALID_NAME);
        }

        $resourceTypeInfo = $this->_currentFolder->getResourceTypeConfig();
        if (!$resourceTypeInfo->checkExtension($sFileName)) {
            $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_INVALID_EXTENSION);
        }

        $sFileNameOrginal = $sFileName;
        $oRegistry->set("FileUpload_fileName", $sFileName);

        $maxSize = $resourceTypeInfo->getMaxSize();
        if (!$_config->checkSizeAfterScaling() && $maxSize && $uploadedFile['size'] > $maxSize) {
            $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_UPLOADED_TOO_BIG);
        }

        $htmlExtensions = $_config->getHtmlExtensions();
        $sExtension = CKFinder_Connector_Utils_FileSystem::getExtension($sFileNameOrginal);

        if ($htmlExtensions
                && !CKFinder_Connector_Utils_Misc::inArrayCaseInsensitive($sExtension, $htmlExtensions)
                && ($detectHtml = CKFinder_Connector_Utils_FileSystem::detectHtml($uploadedFile['tmp_name'])) === true) {
            $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_UPLOADED_WRONG_HTML_FILE);
        }

        $sExtension = CKFinder_Connector_Utils_FileSystem::getExtension($sFileNameOrginal);
        $secureImageUploads = $_config->getSecureImageUploads();
        if ($secureImageUploads
                && ($isImageValid = CKFinder_Connector_Utils_FileSystem::isImageValid($uploadedFile['tmp_name'], $sExtension)) === false) {
            $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_UPLOADED_CORRUPT);
        }

        switch ($uploadedFile['error']) {
            case UPLOAD_ERR_OK:
                break;

            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_UPLOADED_TOO_BIG);
                break;

            case UPLOAD_ERR_PARTIAL:
            case UPLOAD_ERR_NO_FILE:
                $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_UPLOADED_CORRUPT);
                break;

            case UPLOAD_ERR_NO_TMP_DIR:
                $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_UPLOADED_NO_TMP_DIR);
                break;

            case UPLOAD_ERR_CANT_WRITE:
                $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_ACCESS_DENIED);
                break;

            case UPLOAD_ERR_EXTENSION:
                $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_ACCESS_DENIED);
                break;
        }

        $sServerDir = $this->_currentFolder->getServerPath();
        $iCounter = 0;

        while (true) {
            $sFilePath = CKFinder_Connector_Utils_FileSystem::combinePaths($sServerDir, $sFileName);
            if (file_exists($sFilePath)) {
                $iCounter++;
                $sFileName =
                        CKFinder_Connector_Utils_FileSystem::getFileNameWithoutExtension($sFileNameOrginal) .
                        "(" . $iCounter . ")" . "." .
                        CKFinder_Connector_Utils_FileSystem::getExtension($sFileNameOrginal);
                $oRegistry->set("FileUpload_fileName", $sFileName);

                $iErrorNumber = CKFINDER_CONNECTOR_ERROR_UPLOADED_FILE_RENAMED;
            } else {
                if (false === move_uploaded_file($uploadedFile['tmp_name'], $sFilePath)) {
                    $iErrorNumber = CKFINDER_CONNECTOR_ERROR_ACCESS_DENIED;
                } else {
                    if (isset($detectHtml) && $detectHtml === -1 && CKFinder_Connector_Utils_FileSystem::detectHtml($sFilePath) === true) {
                        @unlink($sFilePath);
                        $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_UPLOADED_WRONG_HTML_FILE);
                    } else if (isset($isImageValid) && $isImageValid === -1 && CKFinder_Connector_Utils_FileSystem::isImageValid($sFilePath, $sExtension) === false) {
                        @unlink($sFilePath);
                        $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_UPLOADED_CORRUPT);
                    }
                }
                if (is_file($sFilePath) && ($perms = $_config->getChmodFiles())) {
                    $oldumask = umask(0);
                    chmod($sFilePath, $perms);
                    umask($oldumask);
                }
                /* 加水印 *//* 200*200 以下的图不打水印，gif图不打水印 或 gif打文字水印 */
                if (is_file($sFilePath) && file_exists($sFilePath)) {
                    /* 取后缀 */
                    $ext = end(explode(".", $uploadedFile['name']));
                    if (in_array($ext, array('jpg', 'jpeg', 'png'))) {//图片加水印  'gif',不打水印，要打就加进去
                        $waterImage = $sServerDir . 'shuiyin/souche.gif';
                        $waterImage = str_replace('\\', '/', $waterImage);
                        $this->watermarkImg($sFilePath, $waterImage);
                    }
                }
                break;
            }
        }

        if (!$_config->checkSizeAfterScaling()) {
            $this->_errorHandler->throwError($iErrorNumber, true, false);
        }

        //resize image if required
        require_once CKFINDER_CONNECTOR_LIB_DIR . "/CommandHandler/Thumbnail.php";
        $_imagesConfig = $_config->getImagesConfig();

        if ($_imagesConfig->getMaxWidth() > 0 && $_imagesConfig->getMaxHeight() > 0 && $_imagesConfig->getQuality() > 0) {
            CKFinder_Connector_CommandHandler_Thumbnail::createThumb($sFilePath, $sFilePath, $_imagesConfig->getMaxWidth(), $_imagesConfig->getMaxHeight(), $_imagesConfig->getQuality(), true);
        }

        if ($_config->checkSizeAfterScaling()) {
            //check file size after scaling, attempt to delete if too big
            clearstatcache();
            if ($maxSize && filesize($sFilePath) > $maxSize) {
                @unlink($sFilePath);
                $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_UPLOADED_TOO_BIG);
            } else {
                $this->_errorHandler->throwError($iErrorNumber, true);
            }
        }
    }

    public function watermarkImg($dst_file, $watermark_file) {
        $dst_array = getimagesize($dst_file);
        $water_array = getimagesize($watermark_file);
        $dst_img = $this->createImg($dst_file);
        $water_img = $this->createImg($watermark_file);
        if ($dst_img && $water_img) {
            imagecopymerge($dst_img, $water_img, $dst_array[0] - $water_array[0] - 5, $dst_array[1] - $water_array[1] - 5, 0, 0, $water_array[0], $water_array[1], 50);
            $this->saveImg($dst_file, $dst_img, $dst_array[2]);
        } else {
            return false;
        }
    }

    public function createImg($file) {
        $img_info = getimagesize($file);
        $img = null;
        switch ($img_info[2]) {//1 = GIF 2 = JPG 3 = PNG
            case 1:
                $img = imagecreatefromgif($file);
                break;
            case 2:
                $img = imagecreatefromjpeg($file);
                break;
            case 3:
                $img = imagecreatefrompng($file);
                break;
        }
        return $img;
    }

    public function saveImg($file, $img, $type) {
        //$file='./3.jpg';
        switch ($type) {//1 = GIF 2 = JPG 3 = PNG
            case 1:
                imagegif($img, $file);
                break;
            case 2:
                imagejpeg($img, $file);
                break;
            case 3:
                imagepng($img, $file);
                break;
        }
    }

}
