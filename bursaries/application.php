<?php
include "../config.php";
session_start();

if (!isset($_SESSION['id_number'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bursary application</title>
    <link rel="stylesheet" href="application.css">
</head>
<body>
    <div class="header">
    <h2>CONSTITUENCY BURSARY APPLICATION FORM</h2>
    <p>Please fill out all sections clearly and attach required documents</p>
</div>
    <form action="application_submit.php" method="post" enctype="multipart/form-data">

        <h1>PERSONAL INFORMATION</h1>
        <label for="">Enter your full name</label><br>
        <input type="text" name="full_name" placeholder="EDWIN MONARI" required><br><br>
        <label for="">Enter ID number</label><br>
        <input type="text" name="id_number" placeholder="41362345" required><br><br>
        <label for="">Enter your phone number</label><br>
        <input type="text" name="phone" placeholder="0759465329" required><br><br>
        <label for="">Enter your email address</label><br>
        <input type="email" name="email" placeholder="edwin4543@gmail.com" required><br><br>
        <label for="">Enter your date of birth</label><br>
        <input type="date" name="date" required><br><br>
        <label for="">Choose your ward</label><br>
        <select name="ward" id="">
            <option value="">choose your ward</option>
            <option value="Bokeira">Bokeira</option>
            <option value="Bomwagamo">Bomwagamo</option>
            <option value="Ekerenyo">Ekerenyo</option>
            <option value="Itibo">Itibo</option>
            <option value="Magwagwa">Magwagwa</option>
        </select><br><br>
         <label for="">Do you have any disability</label><br>
         <select name="disability" id="">
            <option value="">select</option>
            <option value="yes">Yes</option>
            <option value="no">No</option>
         </select><br><br>
         <label for="">Are you an ophan</label><br>
         <select name="ophan" id="">
            <option value="">select</option>
            <option value="total ophan">Total ophan</option>
            <option value="single parent">One parent alive</option>
            <option value="both alive">Both parents alive</option>
         </select>

         <h1>EDUCATION DETAILS</h1>
         <label for="">Enter institution name</label><br>
         <input type="text" name="school" required><br><br>
         <label for="">Enter your course/program</label><br>
         <input type="text" name="course" required><br><br>
         <label for="">Enter your admission number</label><br>
         <input type="text" name="admission" required><br><br>
         <label for="">year and date of admission</label><br>
         <input type="date" name="ad_date" required><br>

         <h1>BACKGROUND INFORMATION</h1>
         <label for="">Enter parent(father/mother)/Guardian name</label><br>
         <input type="text" name="parent" placeholder="RICHARD MONARI" required><br><br>
         <label for="">Enter parent(father/mother)/Guardian phone number</label><br>
         <input type="text" name="p_phone" placeholder="0711297314" required><br><br>
         <label for="">Occupation</label><br>
         <input type="text" name="occupation" required><br><br>
         <label for="">Montly income</label><br>
         <input type="text" name="income" required>

         <h1>UPLOAD DOCUMENTS</h1>
         <label for="">Admission letter</label><br>
         <input type="file" name="admission_letter" required><br><br>
         <label for="">Fee structure</label><br>
         <input type="file" name="fee_structure"required><br><br>
         <label for="">copy of parent ID</label><br>
         <input type="file" name="id_copy"required><br><br>
         <label for="">Screenshot of your fee balance</label><br>
         <input type="file" name="fee_balance"required><br><br>

         <h1>DECRALARATION</h1>
         <p>I declare that the information provided is true</p><br>
         <input type="checkbox" required> I Agree
         <br><br>
         <input type="submit" value="Complete application">
         







    </form>
    
</body>
</html>