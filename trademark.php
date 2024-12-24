<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trademark Document Submission Form</title>
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
            max-width: 600px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        select, input[type="file"], button {
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

        .section {
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>Trademark Document Submission</h1>
    <form id="trademarkForm" action="trademark_submission.php" method="post" enctype="multipart/form-data">
        <div class="section">
            <label for="businessType">Select Business Type:</label>
            <select id="businessType" name="businessType" onchange="showFields()">
                <option value="">--Select--</option>
                <option value="proprietorship">Proprietorship</option>
                <option value="partnership">Partnership</option>
                <option value="pvtLtd">Pvt. Ltd.</option>
            </select>
        </div>

        <div class="section">
            <label for="ownerAadhar">Upload Aadhar Card:</label>
            <input type="file" id="ownerAadhar" name="ownerAadhar" required>

            <label for="ownerPan">Upload PAN Card:</label>
            <input type="file" id="ownerPan" name="ownerPan" required>

            <label for="ownerPhoto">Upload Photo:</label>
            <input type="file" id="ownerPhoto" name="ownerPhoto" required>
        </div>

        <div id="partnershipFields" class="section hidden">
            <label for="partnersDocs">Upload All Partners' Aadhar, PAN, and Photo (ZIP file):</label>
            <input type="file" id="partnersDocs" name="partnersDocs">

            <label for="partnershipDeed">Upload Partnership Deed:</label>
            <input type="file" id="partnershipDeed" name="partnershipDeed">
        </div>

        <div id="pvtLtdFields" class="section hidden">
            <label for="directorsDocs">Upload All Directors' Aadhar, PAN, and Photo (ZIP file):</label>
            <input type="file" id="directorsDocs" name="directorsDocs">

            <label for="certificateIncorporation">Upload Certificate of Incorporation:</label>
            <input type="file" id="certificateIncorporation" name="certificateIncorporation">

            <label for="moa">Upload MOA (Memorandum of Association):</label>
            <input type="file" id="moa" name="moa">

            <label for="boardResolution">Upload Board Resolution:</label>
            <input type="file" id="boardResolution" name="boardResolution">
        </div>

        <div class="section">
            <label for="logo">Upload Logo (if applicable):</label>
            <input type="file" id="logo" name="logo">

            <label for="oldDocument">Upload Old Document with Name or Logo (if applicable):</label>
            <input type="file" id="oldDocument" name="oldDocument">
        </div>

        <button type="submit">Submit</button>
    </form>

    <script>
        function showFields() {
            const businessType = document.getElementById('businessType').value;

            // Hide all dynamic sections
            document.getElementById('partnershipFields').classList.add('hidden');
            document.getElementById('pvtLtdFields').classList.add('hidden');

            // Show relevant fields based on selection
            if (businessType === 'partnership') {
                document.getElementById('partnershipFields').classList.remove('hidden');
            } else if (businessType === 'pvtLtd') {
                document.getElementById('pvtLtdFields').classList.remove('hidden');
            }
        }
    </script>
</body>
</html>
