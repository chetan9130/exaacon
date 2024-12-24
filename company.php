<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Company Incorporation & Partnership Deed Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            max-width: 800px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .section {
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="number"],
        input[type="file"],
        button,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #28a745;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <h1>New Company Incorporation & Partnership Deed Form</h1>
    <form id="incorporationForm"  method="POST" action="company_submission.php"  enctype="multipart/form-data">

        <div class="section">
            <label for="businessType">Select Business Type:</label>
            <select id="businessType" name="businessType" onchange="showFields()">
                <option value="">--Select--</option>
                <option value="pvtLtd">Private Limited (Pvt. Ltd.)</option>
                <!-- <option value="partnership">Partnership</option> -->
            </select>
        </div>

        <div class="section">
            <label for="paidUpCapital">Paid Up Capital:</label>
            <input type="number" id="paidUpCapital" name="paidUpCapital">

            <label for="equityShares">Number of Equity Shares (per person):</label>
            <input type="number" id="equityShares" name="equityShares">

            <label for="promotersPan">PAN Card Copies of All Promoters/Directors (Upload ZIP):</label>
            <input type="file" id="promotersPan" name="promotersPan">

            <label for="addressProof">Upload Address Proof (Bank Statement, Electricity Bill, etc.):</label>
            <input type="file" id="addressProof" name="addressProof">
        </div>

        <div class="section">
            <label for="emailIds">Email IDs of Promoters/Directors (comma-separated):</label>
            <input type="text" id="emailIds" name="emailIds">

            <label for="mobileNos">Mobile Nos. of Promoters/Directors (comma-separated):</label>
            <input type="text" id="mobileNos" name="mobileNos">
        </div>

        <div class="section">
            <label for="occupation">Occupation of Promoters/Directors:</label>
            <input type="text" id="occupation" name="occupation">

            <label for="nationality">Nationality of Promoters/Directors:</label>
            <input type="text" id="nationality" name="nationality">
        </div>

        <div class="section">
            <label for="officeOwnerName">Name of Owner/Joint Owners of Registered Office:</label>
            <input type="text" id="officeOwnerName" name="officeOwnerName">

            <label for="officeProof">Upload Latest Office Proof (Telephone Bill, Gas Bill, etc.):</label>
            <input type="file" id="officeProof" name="officeProof">
        </div>

        <div class="section">
            <label for="authorizedShareCapital">Authorized Share Capital of the Company:</label>
            <input type="number" id="authorizedShareCapital" name="authorizedShareCapital">

            <label for="digitalSignature">Upload Digital Signature of All Promoters (ZIP):</label>
            <input type="file" id="digitalSignature" name="digitalSignature">

            <label for="photo">Upload Color Photo (All Promoters):</label>
            <input type="file" id="photo" name="photo">
        </div>

        <div class="section">
            <label for="policeStation">Police Station Name (Registered Office Jurisdiction):</label>
            <input type="text" id="policeStation" name="policeStation">

            <label for="bankName">Name of Bank for Opening Account:</label>
            <input type="text" id="bankName" name="bankName">
        </div>
        

        <button type="submit">Submit</button>
    </form>

    <script>
        function showFields() {
            const businessType = document.getElementById('businessType').value;
            console.log(businessType);  // For future dynamic expansions
        }
    </script>
</body>
</html>
