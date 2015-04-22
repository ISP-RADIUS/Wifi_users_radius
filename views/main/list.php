<div class="row" id="groups-to-print">

    <button class="btn btn-default btn-print">
        Print selected students<br>
        <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
    </button>
    <hr>
    <?php foreach ($groups as $group): ?>
        <div class="col-xs-11 groups-to-print">
            <details>
                <summary class="checkbox">
                    <label class="col-xs-offset"><input type="checkbox" id="<?= $group->group ?>"
                                                        class="groupCheckbox Checkbox"><?= $group->group ?></label>
                    <button class="btn btn-default btn-sm btn-delete-group pull-right">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                </summary>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Tarif</th>
                        <th>Availability</th>
                        <th>Login</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($students as $student): ?>
                        <?php if ($student->group == $group->group): ?>

                            <tr>
                                <td><input type="checkbox" value="<?= $student->username ?>"
                                           class="groupChildCheckbox <?= $student->group ?> CheckboxChild">
                                    <input type="hidden" value="<?= $accounts[$student->username] ?>">
                                    <input type="hidden"
                                           value="<?= $student->last_name . ' ' . $student->first_name . ' ' . $student->middle_name ?>">
                                    <input type="hidden" value="<?= $student->group ?>">
                                </td>
                                <td><?= $student->last_name ?></td>
                                <td><?= $student->first_name ?></td>
                                <td><?= $student->middle_name ?></td>
                                <td><?= $student->tarif ?></td>
                                <td><?= $isDisabled[$student->username] ?></td>
                                <td><?= $student->username ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </details>
        </div>
    <?php endforeach; ?>
</div>
<hr>

<div class="row">
    <div class="col-xs-2">
        <button class="btn btn-default add-group-button" data-toggle="modal" data-target="#basicModal">
            Add Group
        </button>
    </div>
    <div class="col-xs-2">
        <button class="btn btn-default enable-selected-button" disabled>Enable selected</button>
    </div>
    <div class="col-xs-2">
        <button class="btn btn-default disable-selected-button" disabled>Disable selected</button>
    </div>
    <div class="col-xs-2">
        <button class="btn btn-default delete-selected-button" disabled>Delete students</button>
    </div>
</div>


<!--MODAL DIALOG START-->
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Group</h4>
            </div>
            <div class="modal-body">
                <label for="new-group-input">Enter group name</label>
                <input class="form-control" type="text" id="new-group-input">
            </div>
            <div class="modal-footer">
                <button type="button" id="save-group-button" class="btn btn-primary" data-dismiss="modal">Create
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--MODAL DIALOG END-->
