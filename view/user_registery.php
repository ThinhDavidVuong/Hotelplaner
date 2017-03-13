<?php

$form = new Form('/user/doCreate');

echo $form->fault()->message($fault);
echo $form->dropdown()->label('Geschlecht')->name('sex')->options($sexarray);
echo $form->text()->label('Vorname')->name('firstName');
echo $form->text()->label('Nachname')->name('name');
echo $form->text()->label('Mail')->name('email');
echo $form->password()->label('Password')->name('password');
echo $form->password()->label('Password Wiederholen')->name('passwordrepeat');
echo $form->submit()->label('Registrieren')->name('send');
echo $form->linkbutton()->label('Login')->name('loginbutton')->onclick('/user/login');

$form->end();
