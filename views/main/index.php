<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<?php if (empty($groups)): ?>
    <h2 align="center">No groups created: go to <a href="/list">List students</a> tab and add at least one group</h2>
<?php endif; ?>
<?php if (!empty($groups)): ?>
    <div class="row">
        <ul class="nav nav-tabs">
            <li class="active manual"><a href="#manual">Manual add student</a></li>
            <li class="file"><a href="#file">Load students list from file</a></li>
        </ul>
    </div>
    <br>
    <div class="row">
        <div class="manual-add-form">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-xs-8 border">
                <div class="row">

                    <div class="col-xs-4">
                        <?= $form->field($model, 'tarif')->dropDownList($tarifs); ?>
                    </div>
                </div>
                <hr>
                <div class="tab1" style="display: block">
                    <div class="row">
                        <div class="col-xs-4">
                            <?= $form->field($model, 'lastName')->textInput() ?>
                        </div>
                        <div class="col-xs-4">
                            <?= $form->field($model, 'firstName')->textInput() ?>
                        </div>
                        <div class="col-xs-4">
                            <?= $form->field($model, 'middleName')->textInput() ?>
                        </div>
                        <?= Html::activeHiddenInput($model, 'hidden') ?>
                    </div>
                    <div class="form-group">
                        <?= Html::submitButton('Generate',
                            ['class' => 'btn btn-primary', 'id' => 'button-manual-add']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="tab2" style="display: none">
            <div class="file-upload-form">
                <?php $form = ActiveForm::begin([
                    'options' => ['enctype' => 'multipart/form-data']])
                ?>
                <div class="col-xs-3 col-xs-offset-0 border">
                    <?= $form->field($modelFile, 'file')->fileInput() ?>
                    <?= Html::activeHiddenInput($model, 'hidden') ?>

                    <?= Html::submitButton('Upload file and generate',
                        ['class' => 'btn btn-primary', 'id' => 'file-upload-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <hr>
    <div class="row table-data" style="display: none">
        <div class="col-xs-12">
            <h2>List of students to be created</h2>
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>Last name</th>
                    <th>First name</th>
                    <th>Middle name</th>
                    <th>Login</th>
                    <th>Password</th>
                    <th>Tarif</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="table-body">
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-4">
                    <?= $form->field($model, 'group')->dropDownList($groups); ?>
                    <button class="btn btn-primary" id="database-upload">Create new students</button>
                    <button class="btn btn-primary" id="clear-button">Clear</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row error-data" style="display: none">
        <div class="col-xs-7">
            <h4>The lines in file must have only student names! Student name must consist of: Last_name First_name Middle_name</h4><br>
            <h2>Error Log</h2>
            <table class="table table-hover col-xs-5">
                <thead>
                <tr>
                    <th class="col-xs-4">Line number</th>
                    <th class="col-xs-8">String</th>
                </tr>
                </thead>
                <tbody class="error-table-body">
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>