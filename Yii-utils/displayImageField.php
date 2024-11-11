<?php
function displayImageField($form, $model, $attribute)
{
    echo $form->field($model, $attribute)->fileInput(['class' => 'form-control', 'id' => 'formFile']);

    // Check if the model is not new and if the current image exists
    if (!$model->isNewRecord && !empty($model->{$attribute})) {
        // Display the existing image
        echo Html::img(Yii::$app->urlManagerFront->baseUrl . '/public/images/' . $model->{$attribute}, ['style' => 'width:120px']);

        // Hidden input to store the current image filename in case of no new upload
        echo $form->field($model, $attribute)->hiddenInput(['value' => $model->{$attribute}]);

        // Provide an option to remove the image
        echo '<div class="form-group">
                   <label>Remove ' . ucfirst($attribute) . '</label>
                   <input type="checkbox" name="remove_' . $attribute . '" value="1">
                 </div>';
    }
}
