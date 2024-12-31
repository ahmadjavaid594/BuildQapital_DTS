
<section class="panel">

<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="<?=(empty($validation_error) ? 'active' : '') ?>">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> Receipt</a>
			</li>
		</ul>
		<div class="tab-content"  class="container slip-container" id="roll_no_slip_print"> 
		<div class="row">
					<div class="col-md-offset-10 col-md-2">
						<button onClick="printElem()" class="btn btn-default btn-block"><i class="fas fa-print"></i> <?=translate('print')?></button>
					</div>
				</div>
        <table class="table table-bordered table-hover table-condensed mb-none table-export"  border="1" cellspacing="" cellpadding="5">
            <tr>
                
                <th>      <img src="<?= base_url('/uploads/app_image/logo-small.png'); ?>" alt="DTS Logo" style="text-align:center;max-width: 100px; ">
                </th>
                <th><h3>Domestic Testing Services Challan Receipt</h3></th>
            </tr>
            <tr>
                <th>Organization</th>
                <td><?= $jobApplication['organization']; ?></td>
            </tr>
			<tr>
                <th>Receipt No</th>
                <td><?= $jobApplication['unique_id']; ?></td>
            </tr>
            <tr>
                <th>Applicant Name</th>
                <td><?= $applicant['name']; ?></td>
            </tr>
            <tr>
                <th>Applicant Cnic</th>
                <td><?= $applicant['cnic']; ?></td>
            </tr>
            <tr>
                <th>Applicant Mobile No</th>
                <td><?= $applicant['mobileno']; ?></td>
            </tr>
            <tr>
                <th>Applied For</th>
                <td><?= $jobApplication['designation']; ?></td>
            </tr>
           

            <tr>
                <th>Payment Date</th>
                <td><?= date('Y-m-d', strtotime($jobApplication['payment_date'])); ?></td>
            </tr>
            <tr>
                <th>Amount Paid</th>
                <td>PKR <?= $jobApplication['amount']; ?></td>
            </tr>
            <tr>
                <th>Transaction ID</th>
                <td><?= $jobApplication['transaction_id']; ?></td>
            </tr>
            <tr>
                <th>RRN</th>
                <td><?= $challanDetails['pp_RetreivalReferenceNo']; ?></td>
            </tr>
           <!-- <tr>
                <th>Bank Name</th>
                <td><?= $jobApplication['bank_name']; ?></td>
            </tr>!-->
            <tr>
                <th>Payment Mode</th>
                <td><?= $jobApplication['payment_mode']; ?></td>
            </tr>
           
            <tr>
                <th>Transaction Status</th>
                <td><?= $jobApplication['job_status']; ?></td>
            </tr>
            <?php if($jobApplication['payment_mode']=="OTC"){  ?>
            <!--<tr>
                <th>JazzCash Account Title</th>
                <td>Domestic Testing Services Pvt Ltd</td>
            </tr>
            <tr>
                <th>JazzCash Account Number</th>
                <td> 141331124</td>
            </tr>
            <tr>
                <th>JazzCash IBAN</th>
                <td> PK21JCMA0000000141331124</td>
            </tr>!-->
            <tr>
               
                <td class="alert-info" colspan=2> Please take picture of this receipt and visit the nearest jazzcash shop and deposit the challan amount. After depositing the amount your job application will be confirmed in the portal </td>
            </tr>     
            <tr>
              
                <td class="alert-info"  colspan=2>براہ کرم اس رسید کی تصویر لیں اور قریبی جاز کیش شاپ پر جائیں اور چالان کی رقم جمع کرائیں۔ رقم جمع کرنے کے بعد آپ کی ملازمت کی درخواست کی تصدیق پورٹل میں ہو جائے گی۔
                </td>
            </tr>        
            <?php }?>
        </table>
            </div>
      
</div>
</div>
</section>

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