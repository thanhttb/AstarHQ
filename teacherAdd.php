<?php

	$t = Xcrud::get_instance();
    $t->table('teachers');

    $t->relation('major', 'option_major', 'id', 'majorname');
    $t->label($fieldString['teachers']);

   	$t->validation_required('fullname');

   	$t->hide_button('save_return')->hide_button('return');

    echo $t->render('create');