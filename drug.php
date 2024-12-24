<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drug License Document Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            max-width: 800px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            width: 50%;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group select, 
        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .document-section {
            display: none;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .document-section h3 {
            font-size: 1em;
            margin-bottom: 10px;
            color: #444;
        }

        .document-section ul {
            padding-left: 20px;
        }

        .submit-btn {
            display: block;
            width: 50%;
            margin: 20px auto;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1em;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Drug License Document Form</h2>
        <form action="drug_submission.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="form_name" value="Drug Document Submission">

        <!-- Entity Selection -->
        <div class="form-group">
            <label for="entityType">Select Entity Type:</label>
            <select id="entityType" name="entityType" onchange="showDocumentSection()">
                <option value="">-- Please Select --</option>
                <option value="proprietor">Proprietor</option>
                <option value="partnership">Partnership</option>
                <option value="pvtLtd">Private Ltd.</option>
            </select>
        </div>

        <!-- Proprietor Section -->
        <div id="proprietorSection" class="document-section">
            <h3>Proprietor Documents</h3>
            <ul>
                <li>Aadhar Card</li>
                <li>PAN Card</li>
                <li>Photo</li>
            </ul>
            <div class="form-group">
                <label for="aadharCardProprietor">Upload Aadhar Card:</label>
                <input type="file" id="aadharCardProprietor" name="aadharCardProprietor" accept=".jpg, .png, .pdf">
            </div>
            <div class="form-group">
                <label for="panCardProprietor">Upload PAN Card:</label>
                <input type="file" id="panCardProprietor" name="panCardProprietor" accept=".jpg, .png, .pdf">
            </div>
            <div class="form-group">
                <label for="photoProprietor">Upload Photo:</label>
                <input type="file" id="photoProprietor" name="photoProprietor" accept=".jpg, .png, .pdf">
            </div>
        </div>

        <!-- Partnership Section -->
        <div id="partnershipSection" class="document-section">
            <h3>Partnership Documents</h3>
            <ul>
                <li>All Partners' Aadhar Card</li>
                <li>All Partners' PAN Card</li>
                <li>All Partners' Photo</li>
                <li>Partnership Deed</li>
            </ul>
            <div class="form-group">
                <label for="aadharCardPartnership">Upload Aadhar Card (All Partners):</label>
                <input type="file" id="aadharCardPartnership" name="aadharCardPartnership" accept=".jpg, .png, .pdf">
            </div>
            <div class="form-group">
                <label for="panCardPartnership">Upload PAN Card (All Partners):</label>
                <input type="file" id="panCardPartnership" name="panCardPartnership" accept=".jpg, .png, .pdf">
            </div>
            <div class="form-group">
                <label for="photoPartnership">Upload Photo (All Partners):</label>
                <input type="file" id="photoPartnership" name="photoPartnership" accept=".jpg, .png, .pdf">
            </div>
            <div class="form-group">
                <label for="partnershipDeed">Upload Partnership Deed:</label>
                <input type="file" id="partnershipDeed" name="partnershipDeed" accept=".jpg, .png, .pdf">
            </div>
        </div>

        <!-- Private Ltd. Section -->
        <div id="pvtLtdSection" class="document-section">
            <h3>Private Ltd. Documents</h3>
            <ul>
                <li>All Directors' Aadhar Card</li>
                <li>All Directors' PAN Card</li>
                <li>All Directors' Photo</li>
                <li>Certificate of Incorporation</li>
                <li>MOA (Memorandum of Association)</li>
                <li>Board Resolution</li>
            </ul>
            <div class="form-group">
                <label for="aadharCardPvtLtd">Upload Aadhar Card (All Directors):</label>
                <input type="file" id="aadharCardPvtLtd" name="aadharCardPvtLtd" accept=".jpg, .png, .pdf">
            </div>
            <div class="form-group">
                <label for="panCardPvtLtd">Upload PAN Card (All Directors):</label>
                <input type="file" id="panCardPvtLtd" name="panCardPvtLtd" accept=".jpg, .png, .pdf">
            </div>
            <div class="form-group">
                <label for="photoPvtLtd">Upload Photo (All Directors):</label>
                <input type="file" id="photoPvtLtd" name="photoPvtLtd" accept=".jpg, .png, .pdf">
            </div>
            <div class="form-group">
                <label for="certificateOfIncorporation">Upload Certificate of Incorporation:</label>
                <input type="file" id="certificateOfIncorporation" name="certificateOfIncorporation" accept=".jpg, .png, .pdf">
            </div>
            <div class="form-group">
                <label for="moa">Upload MOA (Memorandum of Association):</label>
                <input type="file" id="moa" name="moa" accept=".jpg, .png, .pdf">
            </div>
            <div class="form-group">
                <label for="boardResolution">Upload Board Resolution:</label>
                <input type="file" id="boardResolution" name="boardResolution" accept=".jpg, .png, .pdf">
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>

    <script>
        function showDocumentSection() {
            const entityType = document.getElementById('entityType').value;
            
            // Hide all sections initially
            document.getElementById('proprietorSection').style.display = 'none';
            document.getElementById('partnershipSection').style.display = 'none';
            document.getElementById('pvtLtdSection').style.display = 'none';

            // Show the relevant section based on selection
            if (entityType === 'proprietor') {
                document.getElementById('proprietorSection').style.display = 'block';
            } else if (entityType === 'partnership') {
                document.getElementById('partnershipSection').style.display = 'block';
            } else if (entityType === 'pvtLtd') {
                document.getElementById('pvtLtdSection').style.display = 'block';
            }
        }
    </script>
</body>
</html>
