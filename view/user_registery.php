<?php

$form = new Form('/login/doCreate');

echo $form->fault()->message($fault);
echo $form->dropdown()->label('Geschlecht')->name('sex')->options($sexarray);
echo $form->text()->label('Vorname')->name('firstName');
echo $form->text()->label('Nachname')->name('name');
echo $form->email()->label('Mail')->name('email');
echo $form->password()->label('Password')->name('password')->pattern('^.{8,}$')->titel('Das Passwort muss mindestens 8 Zeichen genthalten.');
echo $form->password()->label('Password Wiederholen')->name('passwordrepeat');
echo $form->submit()->label('Registrieren')->name('send');
echo $form->linkbutton()->label('Login')->name('loginbutton')->onclick('/login/login');

$form->end();
