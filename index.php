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

    use EzForm\Form;
    use EzForm\FormBuilder;
    use EzForm\FormFields;
    use EzForm\Tags\FormTag;
    use EzForm\Tags\InputTag;
use EzForm\Tags\TextAreaTag;

spl_autoload_register( function ($class) {
        $class = str_replace('\\','/',$class) .'.php';
        require_once $class;
    });
?>
<html>
	<head>
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
            ->addField((new InputTag(labelName: 'Login'))->addAttr(['name'=>'email']))
            ->addField((new InputTag(labelName: 'Password'))->addAttr(['type'=>'password', 'name'=>'pwd']))
            ->addField((new TextAreaTag('Description')))
            ->addField((new InputTag(labelName: 'Upload products images'))->addAttr(['type'=>'file', 'name'=>'filesProducts[]']))
            ->addField((new InputTag())->addAttr(['type'=>'submit', 'value'=>'Send']));



        $formBuilder = new FormBuilder($formTag, $fields);

        (new Form($formBuilder))->showForm();
				
		
		
		
		
		
		
		

		
?>
	</body>
</html>