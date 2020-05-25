<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    


</head>
<body>
    <div class="container">
        <h1>Register</h1> 
        <form id="registration_form" action="php.php" method="post">
            <div>
                <input type="text" id="form_fname" name="a" required="">
                <span class="error_form" id="fname_error_message"></span>
                <label>
                    First name
                </label>
            </div>
            <div>
                <input type="text" id="form_sname" name="b" required="">
                <span class="error_form" id="sname_error_message"></span>
                <label>
                    Last Name
                </label>
            </div>
            <div>
                <input type="email" id="form_email" name="c" required="">
                <span class="error_form" id="email_error_message"></span>
                <label>
                    Email
                </label>
            </div>
            <div>
                <input type="password" id="form_password" name="d" required="">
                <span class="error_form" id="password_error_message"></span>
                <label>
                    Password
                </label>
            </div>
            <div>
                <input type="password" id="form_retype_password" name="e" required="">
                <span class="error_form" id="retype_password_error_message"></span>
                <label>
                    Confirm Password
                </label>
            </div>

            <p>Gender</p>
                    <select id="gender" name="f">
                        <option>None</option>
                        <option>Woman</option>
                        <option>Man</option>
                    </select>
           
           <p>Day</p> 
                    <select id="Day" name="g" >
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                        <option>21</option>
                        <option>22</option>
                        <option>23</option>
                        <option>24</option>
                        <option>25</option>
                        <option>26</option>
                        <option>27</option>
                        <option>28</option>
                        <option>29</option>
                        <option>30</option>
                        <option>31</option>
                    </select>

             <p>Month</p>
             <select id="Month" name="h" >
                <option>January</option>
                <option>February</option>
                <option>March</option>
                <option>April</option>
                <option>May</option>
                <option>June</option>
                <option>July</option>
                <option>August</option>
                <option>September</option>
                <option>October</option>
                <option>November</option>
                <option>December</option>
            </select>

            <p>Year</p>
            <select id="Year" name="i" >
                <option>2020</option>
                <option>2019</option>
                <option>2018</option>
                <option>2017</option>
                <option>2016</option>
                <option>2015</option>
                <option>2014</option>
                <option>2013</option>
                <option>2012</option>
                <option>2011</option>
                <option>2010</option>
                <option>2009</option>
                <option>2008</option>
                <option>2007</option>
                <option>2006</option>
                <option>2005</option>
                <option>2004</option>
                <option>2003</option>
                <option>2002</option>
                <option>2001</option>
                <option>2000</option>
                <option>1999</option>
                <option>1998</option>
                <option>1997</option>
                <option>1996</option>
                <option>1995</option>
                <option>1994</option>
                <option>1993</option>
                <option>1992</option>
                <option>1991</option>
                <option>1990</option>
                <option>1989</option>
                <option>1988</option>
                <option>1987</option>
                <option>1986</option>
                <option>1985</option>
                <option>1984</option>
                <option>1983</option>
                <option>1982</option>
                <option>1981</option>
                <option>1980</option>
                <option>1979</option>
                <option>1978</option>
                <option>1977</option>
                <option>1976</option>
                <option>1975</option>
                <option>1974</option>
                <option>1973</option>
                <option>1972</option>
                <option>1971</option>
                <option>1970</option>
                <option>1969</option>
                <option>1968</option>
                <option>1967</option>
                <option>1966</option>
                <option>1965</option>
                <option>1964</option>
                <option>1963</option>
                <option>1962</option>
                <option>1961</option>
                <option>1960</option>
                <option>1959</option>
                <option>1958</option>
                <option>1957</option>
                <option>1956</option>
                <option>1955</option>
                <option>1954</option>
                <option>1953</option>
                <option>1952</option>
                <option>1951</option>
                <option>1950</option>
                <option>1949</option>
                <option>1948</option>
                <option>1947</option>
                <option>1946</option>
                <option>1945</option>
                <option>1944</option>
                <option>1943</option>
                <option>1942</option>
                <option>1941</option>
                <option>1940</option>
            </select>


           <input type="submit" value="Register" name="" >
            
           

        </form>
    </div>

    <div class="output">
    <h1>Output</h1>
<?php



$form_fname = filter_input(INPUT_POST, "a");
$form_sname = filter_input(INPUT_POST, "b");
$form_email = filter_input(INPUT_POST, "c");
$form_password = filter_input(INPUT_POST, "d");
$form_retype_password = filter_input(INPUT_POST, "e");
$f = filter_input(INPUT_POST, "f");
$g = filter_input(INPUT_POST, "g");
$h = filter_input(INPUT_POST, "h");
$i = filter_input(INPUT_POST, "i");


echo "<br>";
echo "<b>First Name:</b>";
echo $form_fname;

echo "<br>";
echo "<b>Last Name:</b>";
echo $form_sname;

echo "<br>";
echo "<b>Email:</b>";
echo $form_email;

echo "<br>";
echo "<b>Password:</b>";
echo $form_password;

echo "<br>";
echo "<b>Gender:</b>";
echo $f;

echo "<br>";
echo "<b>Date:</b>";
echo $g ; 
echo ".";
echo  $h ;
echo  $i;

?>
</div>








<script type="text/javascript">
$(function() {

$("#fname_error_message").hide();
$("#sname_error_message").hide();
$("#email_error_message").hide();
$("#password_error_message").hide();
$("#retype_password_error_message").hide();

var error_fname = false;
var error_sname = false;
var error_email = false;
var error_password = false;
var error_retype_password = false;

$("#form_fname").focusout(function() {
    check_fname();
});
$("#form_sname").focusout(function() {
    check_sname();
});
$("#form_email").focusout(function() {
    check_email();
});
$("#form_password").focusout(function() {
    check_password();
});
$("#form_retype_password").focusout(function() {
    check_retype_password();
});



function check_fname() {
            var pattern = /^[a-zA-Z]*$/;
            var fname = $("#form_fname").val();
            if (pattern.test(fname) && fname !== '') {
               $("#fname_error_message").hide();
               $("#form_fname").css("border-bottom","2px solid #34F458");
            } else {
               $("#fname_error_message").html("Should contain only Characters");
               $("#fname_error_message").show();
               $("#form_fname").css("border-bottom","2px solid #F90A0A");
               error_fname = true;
            }
         }

         function check_sname() {
            var pattern = /^[a-zA-Z]*$/;
            var sname = $("#form_sname").val()
            if (pattern.test(sname) && sname !== '') {
               $("#sname_error_message").hide();
               $("#form_sname").css("border-bottom","2px solid #34F458");
            } else {
               $("#sname_error_message").html("Should contain only Characters");
               $("#sname_error_message").show();
               $("#form_sname").css("border-bottom","2px solid #F90A0A");
               error_fname = true;
            }
         }

         function check_password() {
            var password_length = $("#form_password").val().length;
            if (password_length < 8) {
               $("#password_error_message").html("Atleast 8 Characters");
               $("#password_error_message").show();
               $("#form_password").css("border-bottom","2px solid #F90A0A");
               error_password = true;
            } else {
               $("#password_error_message").hide();
               $("#form_password").css("border-bottom","2px solid #34F458");
            }
         }

         function check_retype_password() {
            var password = $("#form_password").val();
            var retype_password = $("#form_retype_password").val();
            if (password !== retype_password) {
               $("#retype_password_error_message").html("Passwords Did not Matched");
               $("#retype_password_error_message").show();
               $("#form_retype_password").css("border-bottom","2px solid #F90A0A");
               error_retype_password = true;
            } else {
               $("#retype_password_error_message").hide();
               $("#form_retype_password").css("border-bottom","2px solid #34F458");
            }
         }

         function check_email() {
            var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var email = $("#form_email").val();
            if (pattern.test(email) && email !== '') {
               $("#email_error_message").hide();
               $("#form_email").css("border-bottom","2px solid #34F458");
            } else {
               $("#email_error_message").html("Invalid Email");
               $("#email_error_message").show();
               $("#form_email").css("border-bottom","2px solid #F90A0A");
               error_email = true;
            }
         }

         $("#registration_form").submit(function() {
            error_fname = false;
            error_sname = false;
            error_email = false;
            error_password = false;
            error_retype_password = false;

            check_fname();
            check_sname();
            check_email();
            check_password();
            check_retype_password();

            if (error_fname === false && error_sname === false && error_email === false && error_password === false && error_retype_password === false) {
               alert("Registration Successfull");
               return true;
            } else {
               alert("Please Fill the form Correctly");
               return false;
            }


         });
      });

</script>


</body>
</html>