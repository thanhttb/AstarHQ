<?php 
	$t = Xcrud::get_instance();
    $t->table('students');
    $t->columns('lastname,firstname,dateofbirth,gender,phone,currentclass');
    $t->label($fieldString['students']);
    $t->order_by('id', 'desc');


    //$t->button('index.php?page=addParent&sid={id}','Cập nhật thông tin phụ huynh','glyphicon glyphicon-user','',array('target'=>'_blank'));


    // PARENTS
    $parent = $t->nested_table('Phụ huynh','id','parents','studentid'); 
    $parent->columns('studentid', true);
    $parent->fields('studentid', true);
    $parent->label($fieldString['parents']);
    $parent->validation_required('fullname');


    // TAKE PART IN
    $classJoin = $t->nested_table('Tham gia lớp học','id','student_class','studentid'); 
    $classJoin->relation('classid', 'classes', 'id', 'classcode');
    $classJoin->columns('studentid,status,fee', true);
    $classJoin->fields('studentid,status,fee', true);
    //$classJoin->label($fieldString['classes']);

    // ENROLLMENT
    $enroll = $t->nested_table('Nguyện vọng','id','student_enroll','studentid'); 
    $enroll->relation ('major', 'option_major', 'id', 'majorname');
    $enroll->relation ('status', 'option_status', 'id', 'statusname');
    $enroll->columns('id,studentid', true);
    $enroll->fields('year,major,appointment,appointment_note', false, false, 'create');
    $enroll->fields('id,studentid', true, false, 'edit');
    $enroll->label($fieldString['enrollment']);


    $t->unset_add();




    echo $t->render();
