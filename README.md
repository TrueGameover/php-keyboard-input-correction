# php keyboard input correction

Correction of input from the keyboard. Allows validating & correcting wrong input from the keyboard's layout. E.g. writing something on ru layout when en is active.

`$corrector = new \KeyboardInputCorrection\KeyboardInputCorrect();`

Wrong layout's language -
`echo $corrector->correct('ghbdtn');// привет`

Support only en to ru for now.
See tests for more info.

#require PHP >=7.0