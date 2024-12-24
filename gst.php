<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GST Document Form</title>
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
            width: 100%;
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

        .submit-btn {
            display: block;
            width: 100%;
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
        <h2>GST Document Submission</h2>
        <form action="gst_submission.php" method="post" enctype="multipart/form-data">
            <!-- Entity Selection -->
            <input type="hidden" name="form_name" value="GST Document Submission">
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
                <div class="form-group">
                    <label for="aadharCardProprietor">Upload Aadhar Card:</label>
                    <input type="file" id="aadharCardProprietor" name="aadharCardProprietor">
                </div>
                <div class="form-group">
                    <label for="panCardProprietor">Upload PAN Card:</label>
                    <input type="file" id="panCardProprietor" name="panCardProprietor">
                </div>
                <div class="form-group">
                    <label for="photoProprietor">Upload Photo:</label>
                    <input type="file" id="photoProprietor" name="photoProprietor">
                </div>
            </div>

            <!-- Partnership Section -->
            <div id="partnershipSection" class="document-section">
                <div class="form-group">
                    <label for="aadharCardPartnership">Upload Aadhar Card:</label>
                    <input type="file" id="aadharCardPartnership" name="aadharCardPartnership">
                </div>
                <div class="form-group">
                    <label for="panCardPartnership">Upload PAN Card:</label>
                    <input type="file" id="panCardPartnership" name="panCardPartnership">
                </div>
                <div class="form-group">
                    <label for="partnershipDeed">Upload Partnership Deed:</label>
                    <input type="file" id="partnershipDeed" name="partnershipDeed">
                </div>
            </div>

            <!-- Private Ltd Section -->
            <div id="pvtLtdSection" class="document-section">
                <div class="form-group">
                    <label for="certificateOfIncorporation">Upload Certificate of Incorporation:</label>
                    <input type="file" id="certificateOfIncorporation" name="certificateOfIncorporation">
                </div>
                <div class="form-group">
                    <label for="moa">Upload MOA:</label>
                    <input type="file" id="moa" name="moa">
                </div>
                <div class="form-group">
                    <label for="aoa">Upload AOA:</label>
                    <input type="file" id="aoa" name="aoa">
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>

    <script>
        function showDocumentSection() {
            const entityType = document.getElementById('entityType').value;
            document.getElementById('proprietorSection').style.display = 'none';
            document.getElementById('partnershipSection').style.display = 'none';
            document.getElementById('pvtLtdSection').style.display = 'none';

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