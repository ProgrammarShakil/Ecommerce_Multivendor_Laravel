<script>
    let check_boxes = document.querySelectorAll("input[type='checkbox']");

    function checkAll(myCheckbox) {
        if (myCheckbox.checked == true) {
            check_boxes.forEach(checkbox => {
                checkbox.checked = true
            });
        } else {
            check_boxes.forEach(checkbox => {
                checkbox.checked = false
            });
        }
        if (check_boxes.length == 0) {
            myCheckbox.checked == false
        }
    }

    function checkPermissionGroup(className, checkThis) {
        const groupIdName = document.getElementById(checkThis.id);
        const classCheckboxes = document.querySelectorAll('.' + className + ' input');

        if (groupIdName.checked) {
            classCheckboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
        } else {
            classCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
        }
        allCheckPermission()
    }

    function checkSinglePermission(groupClassName, groupIdName, countTotalPermission) {
        const checkedBoxes = document.querySelectorAll('.' + groupClassName + ' input:checked');
        const groupCheckId = document.getElementById(groupIdName);

        if (checkedBoxes.length === countTotalPermission) {
            groupCheckId.checked = true;
        } else {
            groupCheckId.checked = false;
        }
        allCheckPermission()
    }

    function allCheckPermission(){
        const countPermissions = {{count($permissions)}};
        const countPermissionGroups = {{count($permission_group)}};

        if(($("input[type='checkbox']:checked").length) >= countPermissions + countPermissionGroups){
            $('#selectAll').prop('checked', true);
        }else{
            $('#selectAll').prop('checked', false);
        }
    }

</script>
