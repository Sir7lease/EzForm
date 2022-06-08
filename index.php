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

   use src\Form;
   use src\FormBuilder;
   use src\FormFields;
   use src\Tags\FormTag;
   use src\Tags\InputTag;
   use src\Tags\SelectTag;
   use src\Tags\TextAreaTag;

   spl_autoload_register( function ($class) {
      $class = str_replace('\\','/',$class) .'.php';
      require_once $class;
   });
?>

<html lang="fr">
   <head>
      <title>Form Builder</title>
      <!--script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="jquery.multiselect.css"-->
      <style>body{background-color:darkgray;}</style>
   </head>
   <body>
      <?php
         $form = (new Form(['id'=>'toto', 'class'=>'simpleForm color-blue', 'method'=>'POST']))
           ->addField(['Login' => [
             (new InputTag('Email'))->addAttr(['name'=>'email']),
             (new InputTag('Password'))->addAttr(['type'=>'password', 'name'=>'pwd','placeholder'=>'Password']),
             (new SelectTag(labelName: 'Job'))
               ->addOptions([
                 'Developer' => [
                   'dev_1'=>'DevBack',
                   'dev_2'=>'DevFront',
                   'dev_3'=>'FullStack',
                 ],
                 'Technician' => [
                   'tech_1'=>'IT Technician',
                   'tech_2'=>'Network Technician',
                 ] ,
                 'adm_rsx'=>'Administrateur Réseaux'
               ])
           ]])
           ->addField((new InputTag())->addAttr(['name'=>'randomTest']))
           ->addField((new SelectTag('Gender'))->addAttr(['name'=>'gender'])->addOptions(['1'=>'Monsieur','2'=>'Madame']))
           ->addField(['Products' => [
             (new TextAreaTag('Description')),
             (new InputTag('Upload products images'))->addAttr(['type'=>'file', 'name'=>'filesProducts[]', 'multiple'])
           ]])
           ->addField((new InputTag())->addAttr(['type'=>'submit', 'value'=>'Send']));

         (new FormBuilder([
           'fl' => 'div, div',
           'l' => 'div',
           'f' => 'div, span']))
         ->buildForm($form)
         ->renderForm();
      ?>
	</body>
   <!--script src="jquery.multiselect.js"></script>
   <script>
       $('#id_3').multiselect( 'loadOptions', [{
           name   : 'Option Name 1',
           value  : 'option-value-1',
           checked: false,
           attributes : {
               custom1: 'value1',
               custom2: 'value2'
           }
       },{
           name   : 'Option Name 2',
           value  : 'option-value-2',
           checked: false,
           attributes : {
               custom1: 'value1',
               custom2: 'value2'
           }
       }]);
   </script-->
</html>