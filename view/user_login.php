<?php

$form = new Form('/user/dologin');

echo $form->fault()->message($fault);
echo $form->text()->label('Mail')->name('email');
echo $form->password()->label('Password')->name('password');
echo $form->submit()->label('Login')->name('send');
echo $form->linkbutton()->label('Registrieren')->name('loginbutton')->onclick('/user/registery');

$form->end();
