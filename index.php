<!DOCTYPE>
<html>
<head>
    <meta name="viewport" content="width-device-width" intial-scale="1.0">
    <title>PHP Form Validation</title>
    <style>
        body {
    font-family: "Inter", sans-serif;
    background-color: #f0f2f5;
    display: flex;
    justify-content: center;
    align-items: flex-start; /* Align to start instead of center vertically */
    min-height: 100vh;
    margin: 20px 0; /* Add vertical margin */
    padding: 0 15px; /* Add horizontal padding for smaller screens */
    box-sizing: border-box; /* Include padding in element's total width and height */
}

.container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 500px;
    box-sizing: border-box;
}

h2 {
    color: #333;
    text-align: center;
    margin-bottom: 25px;
}

form div {
    margin-bottom: 18px;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #555;
    font-weight: 500;
}

input[type="text"],
textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-sizing: border-box;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

input[type="text"]:focus,
textarea:focus {
    border-color: #667eea; /* Tailwind-like purple */
    outline: none;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
}

.radio-group label {
    display: inline-block;
    margin-right: 15px;
    font-weight: normal;
}

.error {
    color: #ef4444; /* Tailwind red-500 */
    font-size: 0.9em;
    margin-top: 5px;
    display: block;
}

input[type="submit"] {
    background-color: #667eea; /* Tailwind-like purple */
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 18px;
    font-weight: 600;
    width: 100%;
    transition: background-color 0.3s ease, transform 0.2s ease;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

input[type="submit"]:hover {
    background-color: #5a67d8; /* Darker purple on hover */
    transform: translateY(-2px);
}

.input-summary {
    background-color: #e0f2f7; /* Light blue background */
    border: 1px solid #a7d9e8;
    padding: 20px;
    border-radius: 8px;
    margin-top: 30px;
    color: #333;
}

.input-summary h3 {
    margin-top: 0;
    color: #2a65a2; /* Darker blue for heading */
}

.input-summary p {
    margin-bottom: 8px;
}

.input-summary p strong {
    color: #4a5568; /* Dark grey for labels */
}
</style>
</head>
<body>
    <div class="container">
        <?php
        $nameError= $emailErr = $genderErr =$websiteErr="";
        $name= $email = $gender =$comment = $website= "";
        $formSubmittedSuccessfully= false;

        function test_input($data){
            $data= trim($data);
            $data=stripslashes($data);
            $data= htmlspecialchars($data);
            return data;
        }
        if ($_SERVER["REQUEST_METHOD"]=="POST"){
            if (empty($_POST["name"])){
                $nameErr="Name is required";
            }else{
                $name= test_input($_POST["name"]);
                if(!preg_match("/^[a-zA-Z-']*$/", $name)){
                    $nameErr="Only letters and white space allowed";
                }
            }
            if (empty($_POST["email"])){
                $email= test_input($_POST["email"]);
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $emailErr="Invalid email format";
                }
            }
            if(!empty($_POST["website"])){
                $website= test_input($_POST["website"]);
                if(!filter_var($website, FILTER_VALIDATE_URL)){
                    $websiteErr="Invalid URL format";
                }
            } else{
                $website="";
            }
            $comment=test_input($_POST["comment"]);

            if(empty($_POST["gender"])){
                $genderErr="Gender is required";
            } else{
                $gender=test_input($_POST["gender"]);
            }
            if (empty($nameErr)&& empty($emailErr)&& empty($genderErr)&& empty($websiteErr)){
                $formSubmittedSuccessfully= true;
            }
        }
        ?>
        <h2>PHP form validation example </h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
                <span class="error"><?php echo $nameErr:?></span>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <span class="error"><?php echo $emailErr:?></span>
            </div>
        

