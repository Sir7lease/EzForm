<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    function pretty($obj): void
    {
        echo "<pre>";
        print_r ( $obj );
        echo "</pre>";
    }

    use EzForm\FormBuilder;
    use EzForm\FormFields;
    use EzForm\Tags\FormTag;
    use EzForm\Tags\InputTag;
use EzForm\Tags\SelectTag;
use EzForm\Tags\TextAreaTag;

spl_autoload_register( function ($class) {
        $class = str_replace('\\','/',$class) .'.php';
        require_once $class;
    });
?>
<html lang="fr">
	<head>
        <title>Form Builder</title>
        <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script-->
		<style>body{background-color:darkgray;}</style>
	</head>
	<body>
<?php
        $formTag = (new FormTag())->addAttr([
            'id'=>'toto',
            'class'=>'simpleForm color-blue',
            'method'=>'POST'
        ]);

        $fields = (new FormFields())
            ->addFieldset('Login')
            ->addField((new InputTag(labelName: 'Login'))->addAttr(['name'=>'email']), 'Login')
            ->addField((new InputTag(labelName: 'Password'))->addAttr(['type'=>'password', 'name'=>'pwd']), 'Login')
            ->addField((new SelectTag(labelName: 'Job'))->addAttr(['name'=>'job'])->addOptions(['job_1'=>'DevBack','job_2'=>'DevFront','job_3'=>'FullStack']))
            ->addField((new TextAreaTag(labelName: 'Description')))
            ->addField((new InputTag(labelName: 'Upload products images'))->addAttr(['type'=>'file', 'name'=>'filesProducts[]']))
            ->addField((new SelectTag(labelName: 'Gender'))->addAttr(['name'=>'gender'])->addOptions(['1'=>'Monsieur','2'=>'Madame']), 'Login')
            ->addField((new InputTag())->addAttr(['type'=>'submit', 'value'=>'Send']));

        (new FormBuilder())
            ->buildForm($formTag, $fields)
            ->renderForm();









		
?>
	</body>
</html>