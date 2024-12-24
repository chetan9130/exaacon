<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Udyam Aadhaar Document Submission Form</title>
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
            max-width: 500px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        select, input[type="text"], input[type="file"], button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Udyam Aadhaar Document Submission</h1>
    <form id="udyamForm" action="udhyam_submission.php" method="POST" enctype="multipart/form-data">
        <label for="businessType">Select Business Type:</label>
        <select id="businessType" name="businessType" onchange="showFields()">
            <option value="">--Select--</option>
            <option value="proprietor">Proprietor</option>
            <option value="partnership">Partnership</option>
            <option value="pvtLtd">Pvt. Ltd.</option>
        </select>

        <div id="ownerDocuments">
            <label for="ownerAadhar">Owner Aadhar Card:</label>
            <input type="file" id="ownerAadhar" name="ownerAadhar">

            <label for="ownerPan">Owner PAN Card:</label>
            <input type="file" id="ownerPan" name="ownerPan">
        </div>

        <div id="partnershipFields" class="hidden">
            <label for="partnersDocs">All Partners' Aadhar and PAN (ZIP file):</label>
            <input type="file" id="partnersDocs" name="partnersDocs">

            <label for="partnershipDeed">Partnership Deed:</label>
            <input type="file" id="partnershipDeed" name="partnershipDeed">
        </div>

        <div id="pvtLtdFields" class="hidden">
            <label for="directorsDocs">All Directors' Aadhar and PAN (ZIP file):</label>
            <input type="file" id="directorsDocs" name="directorsDocs">

            <label for="certificate">Certificate of Incorporation:</label>
            <input type="file" id="certificate" name="certificate">

            <label for="moa">MOA:</label>
            <input type="file" id="moa" name="moa">

            <label for="boardResolution">Board Resolution:</label>
            <input type="file" id="boardResolution" name="boardResolution">
        </div>

        <label for="bankDetails">Bank Details:</label>
        <input type="text" id="bankDetails" name="bankDetails" placeholder="Enter bank details">

        <button type="submit">Submit</button>
    </form>

    <script>
        function showFields() {
            const businessType = document.getElementById('businessType').value;

            // Hide all sections initially
            document.getElementById('partnershipFields').classList.add('hidden');
            document.getElementById('pvtLtdFields').classList.add('hidden');

            if (businessType === 'partnership') {
                document.getElementById('partnershipFields').classList.remove('hidden');
            } else if (businessType === 'pvtLtd') {
                document.getElementById('pvtLtdFields').classList.remove('hidden');
            }
        }
    </script>
</body>
</html>
