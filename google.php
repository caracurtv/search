<?php
// ���������� ���������������� ������
error_reporting(0);
$sait="../";
header("Content-type: text/html; charset=windows-1251");

//------------------------------------------------------------------------------------------------------------
// ������� ������ ������������ �� ���������-������.
function search_in_file($file_name,$str)
{

 $f=fopen($file_name,"r");
 //echo "������� $file_name";
 $result=false;
 $rez="";
static $nm=0;
while(!feof($f))
 {
  $line=fgets($f);
  $line=strtolower($line);
  if(strpos($line,$str)===false)
   {
     $result=false;
   }
    else

      {
       $nm++;
       $first=strpos($line,$str);
       $last=strlen(substr($line,0,$first))+strlen($str);
       $s1=substr($line,$first-40,40);
       $s1=str_replace("<","",$s1);
       for($i=0;$i<strlen($s1)-1;$i++)
          {
           if($s1[$i]==" " && $s1[$i+1]==" ")
          	$s1[$i]="";
          }
       $s2=substr($line,$last,40);


       echo "<a href='$file_name'><font color=blue>������ $nm</font></a><br>";
       echo "..$s1<b>$str</b>$s2..<br>";
       echo "����:<font color=green>$file_name</font><br><br>";

      }
 }
 fclose($f);

}

//------------------------------------------------------------------------------------------------------------

// ������� ����������� ������ �� ���� ���������
 function search_show($root_dir,$str)
 {
 if (is_dir($root_dir))//���� ��� �������
  {
    if ($dh = opendir($root_dir))//���� ������� ������� �������
    {
      while(($dir = readdir($dh)) !== false)//������ ���� ���������
       {
          if( $dir!="." & $dir!=".." )//���� ������ �������� ��� ������
            {

             if($root_dir.$dir!=="."&& filetype($root_dir.$dir)=="file" && strrchr($root_dir.$dir,".html")==".html"|| strrchr($root_dir.$dir,".htm")=="htm"||strrchr($root_dir.$dir,".HTML")==".HTML"|| strrchr($root_dir.$dir,".HTM")=="HTM")
              {
               // ������� ������ ������ � ����� $root_dir.$dir
              // echo $dir."<br>";
               $file_name=$root_dir.$dir;
               search_in_file($file_name,$str);

              }
             search_show($root_dir.$dir."/",$str);
            }


         }

       }
        closedir($dh);
     }

  }


if (isset($_GET['q']))
{
 $q=$_GET['q'];
 search_show($sait,$q);}





?>