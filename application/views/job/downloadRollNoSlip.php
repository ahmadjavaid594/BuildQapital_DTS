<?php
// Example data to encode in the QR code
$qrData = "rollNo:".$applicant['unique_id'].'mobileNo:'.$applicant['mobileno'].'testDate:'.$applicant['date'].'startTime'.$applicant['start_time'].'endtime'.$applicant['end_time'];

// Encode the data into a URL-safe format
$qrDataEncoded = urlencode($qrData);

// Generate the QR code URL
$qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=$qrDataEncoded";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roll Number Slip</title>
    <!-- Include Bootstrap CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .slip-container {
            border: 2px solid #333;
            padding: 20px;
            margin: 20px auto;
            max-width: 900px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .header-text {
            font-size: 1.4rem;
            font-weight: bold;
            text-align: center;
            color: #333;
        }
        .sub-header {
            font-size: 1rem;
            font-weight: bold;
            text-align: center;
            color: #666;
        }
        .logo {
            max-width: 80px;
            max-height 80px;
        }
        .img-thumbnail {
            border: 2px solid #333;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #333;
            vertical-align: middle;
        }
        .barcode img, .qr-code img {
            max-width: 200px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .instructions, .urdu-text {
            font-size: 1.05rem;
            line-height: 1.5;
            margin-top: 20px;
        }
        .urdu-text {
            font-family: 'Jameel Noori Nastaleeq', 'Noto Nastaliq Urdu', serif;
            direction: rtl;
            text-align: right;
        }
        .footer-note {
            font-size: 0.85rem;
            text-align: center;
            margin-top: 15px;
            color: #555;
        }
    </style>
</head>
<body>

				<div class="row">
					<div class="col-md-offset-10 col-md-2">
						<button onClick="printElem()" class="btn btn-default btn-block"><i class="fas fa-print"></i> <?=translate('print')?></button>
					</div>
				</div>
			
    <div class="container slip-container" id="roll_no_slip_print">
        <!-- Header Section -->
        <table class="table table-borderless w-100">
    <tr>
        <td class="text-center" style="width: 25%;">
            <br>
            <img src="<?= base_url('assets/images/logo.png'); ?>" alt="ETEA Logo" class="logo" style="max-width: 100px; height:70px">
        </td>
        <td class="text-center" style="width: 50%;">
            <br>
            <p style="font-size: 1.4rem; font-weight: bold;">Domestic Testing Services (DTS)</p>
            <p class="sub-header" style="font-size: 1rem; font-weight: bold; color: #666;">ROLL NUMBER SLIP</p>
        </td>
        <td class="text-center" style="width: 25%;">
            <img src="<?= base_url($applicant['photo']); ?>" alt="Applicant Photo" class="img-thumbnail" style="width: 100px; height:100px">
        </td>
    </tr>
</table>


        <hr>

        <!-- Reference Section -->
        <div class="text-center">
            <p><strong>Rectt: <?=  $applicant['designation'].' ('.$applicant['organization'].')' ?></strong></p>
        </div>
        <p class="mb-4">Reference to your application for the above-referred test, the test is scheduled as per the details mentioned below:</p>

        <!-- Applicant Details Section -->
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>ROLL NUMBER</th>
                    <td><?= $applicant['unique_id']; ?></td>
                </tr>
                <tr>
                    <th>CNIC No.</th>
                    <td><?= $applicant['cnic']; ?></td>
                </tr>
                <tr>
                    <th>NAME</th>
                    <td><?= $applicant['name']; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= $applicant['email']; ?></td>
                </tr>
                <tr>
                    <th>GENDER</th>
                    <td><?= $applicant['sex']; ?></td>
                </tr>
                <tr>
                    <th>RELIGION</th>
                    <td><?= $applicant['religion']; ?></td>
                </tr>
                <tr>
                    <th>APPLIED FOR</th>
                    <td><?= $applicant['designation']; ?></td>
                </tr>
                <tr>
                    <th>MOBILE NO</th>
                    <td><?= $applicant['mobileno']; ?></td>
                </tr>
                <tr>
                    <th>TEST DATE</th>
                    <td><?= $applicant['date']; ?></td>
                </tr>
                <tr>
                    <th>TEST TIME</th>
                    <td><?= $applicant['start_time'].' - '.$applicant['end_time']; ?></td>
                </tr>
                <tr>
                    <th>TEST CENTER</th>
                    <td><?= $applicant['center']; ?></td>
                </tr>
            </tbody>
        </table>
     
        <!-- Barcode and QR Code Section -->
     
      
        <!-- Urdu Instructions Section -->
        <div class="urdu-text mt-5">
            <strong>ہدایات:</strong>
            <ol>
                <li>آپ کو عارضی طور پر اس امتحان میں شرکت کے لیے داخل کیا گیا ہے۔ اپنی اہلیت یقینی بنائیں۔</li>
                <li>یہ رول نمبر سلپ، اپنا اصل شناختی کارڈ اور دیگر ضروری دستاویزات ساتھ لائیں۔</li>
                <li>رپورٹنگ وقت سے 30 منٹ پہلے پہنچیں۔</li>
                <li>امتحان میں موبائل فون اور دیگر برقی آلات ممنوع ہیں۔</li>
                <li>نگراں عملے کی ہدایات پر عمل کریں۔</li>
            </ol>
        </div>

        <!-- General Instructions Section -->
        <br>
        <table class="table table-borderless w-100">
    <tr>
        <td class="text-left" style="width: 75%;">
            <strong>General Instructions:</strong>
            <ol>
                <li>You are admitted to the above test/exam provisionally. Ensure your eligibility before appearing.</li>
                <li>Bring this Roll Number Slip along with your original CNIC and other required documents.</li>
                <li>Reach the test center at least 30 minutes before the test time.</li>
                <li>Mobile phones, calculators, and electronic devices are strictly prohibited in the exam hall.</li>
                <li>Follow the instructions of the invigilator and maintain discipline in the exam hall.</li>
            </ol>
        </td>
        <td class="text-center" style="width: 25%;">
            <img src="<?= $qrCodeUrl ?>" alt="QR Code" style="max-width: 150px;">
        </td>
    </tr>
</table>

       
        
        
        <!-- Footer Section -->
        <p class="footer-note">For further information, visit our website: <strong>www.dts.org.pk</strong></p>
    </div>
</body>
</html>

<script type="text/javascript">
	// print function
    window.onload = function() {
        printElem(); // This will call the print function as soon as the page is loaded
    };
	function printElem()
	{
	    var oContent = document.getElementById('roll_no_slip_print').innerHTML;
	    var frame1 = document.createElement('iframe');
	    frame1.name = "frame1";
	    frame1.style.position = "absolute";
	    frame1.style.top = "-1000000px";
	    document.body.appendChild(frame1);
	    var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
	    frameDoc.document.open();
	    //Create a new HTML document.
	    frameDoc.document.write('<html><head><title></title>');
	    frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'assets/vendor/bootstrap/css/bsprint.min.css">');
	    frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'assets/css/custom-style.css">');
	    frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'assets/css/ramom.css">');
	    frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'assets/css/rollnoslip.css">');
	    frameDoc.document.write('</head><body>');
	    frameDoc.document.write(oContent);
	    frameDoc.document.write('</body></html>');
	    frameDoc.document.close();
	    setTimeout(function () {
	        window.frames["frame1"].focus();
	        window.frames["frame1"].print();
	        frame1.remove();
	    }, 500);
	    return true;
	}
</script>