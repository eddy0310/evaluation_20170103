<?php

error_reporting(E_NOTICE);
$index= fopen("resultat/index.html", "w+");
$question=file("questions.qs");
$tab = [];

foreach($question as $numeroligne => $repere){
       if (substr_count($repere, "#")==2){
           $tab[] = $repere; }

       if (substr_count($repere, "#")==1) {
           $quest["texte"][]=$repere;
           $quest["theme"][]=count($tab)-1;
           }
       if (preg_match_all("/^\-/", $repere)) {
           $rip["texte"][] = $repere;
           $rip["numquestion"][] = count($quest["texte"])- 1;
               }
   }



fputs($index,'<html><head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>evaluations du 03 janvier 2017 – ville</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head><body><h1>evaluations du 03 janvier 2017 – Beziers</h1>
<h2>lecaille eddy</h2><article><form action="../evaluation.php" method="POST" >

');
for ($i=0; $i <count($tab) ; $i++)
{
fputs($index, '<section><h3>'.$tab[$i].'</h3></section>');

   for ($j=0; $j < count($quest["texte"]) ; $j++) {
$testqcm = false;
       if ($quest["theme"][$j]==$i) {
           fputs($index, '<div class="quest">'.$quest["texte"][$j].'</div>');

           for ($k=0; $k < count($rip["texte"]); $k++) {
               if($rip["numquestion"][$k] == $j){
                   fputs($index, '<div><input type="radio" name='. $j .' value="'.$rip["texte"][$k].'">'.$rip["texte"][$k]. '</div>');
                       $testqcm=true;
                       }
                   }

           if($testqcm==false){
                   fputs($index,'<input type="texte_area" name='. $j .' value="">');
           }
       }
   }
}

fputs($index, "<input type=\"submit\" value=\"test\" ></form></article</body></html>");

fclose($index);

$resultat= fopen("resultat.xml", "w+");

for ($i=0; $i <count($quest["texte"]) ; $i++){
  fputs($resultat,"<Question " .$i.">". $_POST[$i]);


}


print_r($_POST);
