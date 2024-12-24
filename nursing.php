<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bombay Nursing Home Document Form</title>
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
            width: 50%;
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
        <h2>Bombay Nursing Home Document Submission</h2>
        <form action="nursing_submission.php" method="post" enctype="multipart/form-data">
            <!-- Entity Selection -->
            <input type="hidden" name="form_name" value="Bombay Nursing Home Document">
            <div class="form-group">
                <label for="entityType">Select Entity Type:</label>
                <select id="entityType" name="entityType" onchange="showDocumentSection()">
                    <option value="">-- Please Select --</option>
                    <option value="proprietor">Proprietor</option>
                    <option value="partnership">Partnership Firm</option>
                    <option value="pvtLtd">Private Ltd./LLP</option>
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
                    <label for="partnershipDeed">Upload Partnership Deed (ROF):</label>
                    <input type="file" id="partnershipDeed" name="partnershipDeed">
                </div>
                <div class="form-group">
                    <label for="aadharCardPartners">Upload All Partners' Aadhar Card:</label>
                    <input type="file" id="aadharCardPartners" name="aadharCardPartners">
                </div>
                <div class="form-group">
                    <label for="panCardPartners">Upload All Partners' PAN Card:</label>
                    <input type="file" id="panCardPartners" name="panCardPartners">
                </div>
                <div class="form-group">
                    <label for="photoPartners">Upload All Partners' Photos:</label>
                    <input type="file" id="photoPartners" name="photoPartners">
                </div>
            </div>

            <!-- Private Ltd./LLP Section -->
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
                <div class="form-group">
                    <label for="aadharCardDirectors">Upload All Directors' Aadhar Card:</label>
                    <input type="file" id="aadharCardDirectors" name="aadharCardDirectors">
                </div>
                <div class="form-group">
                    <label for="panCardDirectors">Upload All Directors' PAN Card:</label>
                    <input type="file" id="panCardDirectors" name="panCardDirectors">
                </div>
                <div class="form-group">
                    <label for="photoDirectors">Upload All Directors' Photos:</label>
                    <input type="file" id="photoDirectors" name="photoDirectors">
                </div>
            </div>

            <!-- Place Documents Section -->
            <div class="form-group">
                <label for="uttaraDocument">Upload Place Document (Uttara):</label>
                <input type="file" id="uttaraDocument" name="uttaraDocument">
            </div>
            <div class="form-group">
                <label for="mpcbConsent">Upload MPCB Consent:</label>
                <input type="file" id="mpcbConsent" name="mpcbConsent">
            </div>
            <div class="form-group">
                <label for="taxReceipt">Upload Latest Paid Tax Receipt:</label>
                <input type="file" id="taxReceipt" name="taxReceipt">
            </div>
            <div class="form-group">
                <label for="waterBill">Upload Latest Water Bill Paid Copy:</label>
                <input type="file" id="waterBill" name="waterBill">
            </div>
            <div class="form-group">
                <label for="fireNoc">Upload Fire NOC:</label>
                <input type="file" id="fireNoc" name="fireNoc">
            </div>
            <div class="form-group">
                <label for="rentAgreement">Upload Rent Agreement (Registered):</label>
                <input type="file" id="rentAgreement" name="rentAgreement">
            </div>
            <div class="form-group">
                <label for="plan">Upload Plan:</label>
                <input type="file" id="plan" name="plan">
            </div>
            <div class="form-group">
                <label for="bioMedicalWaste">Upload Bio Medical Waste Registration Copy:</label>
                <input type="file" id="bioMedicalWaste" name="bioMedicalWaste">
            </div>
            <div class="form-group">
                <label for="corporationNoc">Upload Corporation NOC:</label>
                <input type="file" id="corporationNoc" name="corporationNoc">
            </div>

            <!-- Doctor and Staff Documents Section -->
            <div class="form-group">
                <label for="doctorAadhar">Upload Doctor/Staff Aadhar Card:</label>
                <input type="file" id="doctorAadhar" name="doctorAadhar">
            </div>
            <div class="form-group">
                <label for="doctorPhoto">Upload Doctor/Staff Photo:</label>
                <input type="file" id="doctorPhoto" name="doctorPhoto">
            </div>
            <div class="form-group">
                <label for="degreeCertificate">Upload Degree Certificate:</label>
                <input type="file" id="degreeCertificate" name="degreeCertificate">
            </div>
            <div class="form-group">
                <label for="visitingSurgeonAffidavit">Upload Visiting Surgeon Affidavit (On Stamp):</label>
                <input type="file" id="visitingSurgeonAffidavit" name="visitingSurgeonAffidavit">
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
