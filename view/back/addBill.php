
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a bill</title>
    <link rel="stylesheet" href="../../Assets/CSS Styles/addBill.css">
</head>
<body>
    <header>
        <h1>Add a bill</h1>
    </header>

    <main>
        <a href="listBills.php">Check Clinic Bill History</a>
        <hr>


        <form align="center" action="sendBillMail.php" method="POST">
            <label for="patient_id">Patient ID :</label>
            <input type="text" id="patient_id" name="id_patient">
            <button type="submit">Submit</button>
        </form>
    </main>
</body>
</html>

