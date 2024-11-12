<?php
function validateAndUploadImage($model, $attribute, $path, $allowedFileTypes, $maxFileSize)
{
    $file = UploadedFile::getInstance($model, $attribute);

    if ($file) {
        if (!in_array($file->type, $allowedFileTypes)) {
            Yii::$app->getSession()->setFlash('error', 'Invalid file type for ' . $attribute);
            return null;
        }

        if ($file->size > $maxFileSize) {
            Yii::$app->getSession()->setFlash('error', 'File size exceeds the limit for ' . $attribute);
            return null;
        }

        $fileName = uniqid($attribute . '_') . '.' . $file->extension;
        $file->saveAs($path . '/' . $fileName);

        return $fileName;
    }

    return null;
}
