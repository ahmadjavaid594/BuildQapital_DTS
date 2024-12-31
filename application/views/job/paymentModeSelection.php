<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="panel">
            <div class="row widget-row-in">
                <div class="col-md-12 card service-card" style="padding:10px; text-align:center; margin:auto;">
                    <h3 style="margin-top:5px; margin-bottom:5px; color:Red; padding:10px;">
                        Thanks for applying for the post of <?=$jobApplication['designation'] ?> in <?=$jobApplication['organization'] ?>. In order to confirm your job application please pay challan using one of the following options.
                    </h3>
                    <br>
                    <!--<div style="background-color: #fff; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); width: 300px; margin: 10px; padding: 20px; display: inline-block; vertical-align: top;">
                        <h3 style="margin: 0 0 10px; font-size: 18px; color: #333;">1. JazzCash</h3>
                        <br>
                        <br>
                        <p style="margin: 5px 0; color: #555;">Pay using your JazzCash Account.</p>
                        <br>
                        <br>
                        <?php if ($jobApplication['payment_mode'] != 'Card Payment' && $jobApplication['payment_mode'] != 'JazzCash Wallet'  && $jobApplication['payment_mode'] != 'Manual' && $jobApplication['payment_mode'] != 'OTC' ){ ?>
                        <a href="<?=base_url('job/payChallan/'.$jobApplication['unique_id'])?>" class="btn" style="background-color: #FF4500; color: white; border: none; border-radius: 5px; padding: 10px 20px; margin-top: 10px; cursor: pointer;">
                        Pay with JazzCash</a>
                        <?php }?>
                    </div>!-->
                    <div style="background-color: #fff; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); width: 300px; margin: 10px; padding: 20px; display: inline-block; vertical-align: top;">
                        <h3 style="margin: 0 0 10px; font-size: 18px; color: #333;">1. Pay at nearest JazzCash Merchant</h3>
                        <br>
                        <br>
                        <p style="margin: 5px 0; color: #555;">Over-the-counter payment at JazzCash agents.</p>
                        <br>
                        
                        <?php if ($jobApplication['payment_mode'] != 'Card Payment' && $jobApplication['payment_mode'] != 'JazzCash Wallet'  && $jobApplication['payment_mode'] != 'Manual' && $jobApplication['payment_mode'] != 'OTC' ){ ?>
                        <a href="<?=base_url('job/payViaOTC/'.$jobApplication['unique_id'])?>" class="btn" style="background-color:rgb(47, 91, 173); color: white; border: none; border-radius: 5px; padding: 10px 20px; margin-top: 10px; cursor: pointer;">
                        JazzCash</a>
                        <?php }?>
                    </div>

                    <div style="background-color: #fff; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); width: 300px; margin: 10px; padding: 20px; display: inline-block; vertical-align: top;">
                        <h3 style="margin: 0 0 10px; font-size: 18px; color: #333;">2. Pay Using Your Debit/Credit Card</h3>
                        <br>
                        <br>
                        <?php
if (!isset($url) || !isset($parameters)) {
    die('Required variables are not set.');
}
?>
<form id="autoSubmitForm" method="post" action="<?= htmlspecialchars($url) ?>">
    <?php
  
    
    foreach ($parameters as $key => $value) {
        echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
    }
    ?>
    <p style="margin: 5px 0; color: #555;">Pay securely using your Debit/Credit card through our payment gateway.</p>
    <br>
   
    <?php if ($jobApplication['payment_mode'] != 'Card Payment' && $jobApplication['payment_mode'] != 'JazzCash Wallet' && $jobApplication['payment_mode'] != 'Manual' && $jobApplication['payment_mode'] != 'OTC' ){ ?>
                        
    <button type="submit" style="background-color: #008CBA; color: white; border: none; border-radius: 5px; padding: 10px 20px; margin-top: 10px; cursor: pointer;">Card Payment</button>
    <?php } ?>
</form>
 
                    </div>
                    <div style="background-color: #fff; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); width: 300px; margin: 10px; padding: 20px; display: inline-block; vertical-align: top;">
                        <h3 style="margin: 0 0 10px; font-size: 18px; color: #333;">3. JazzCash Wallet Account</h3>
                        <br>
                        <br>
                        <p style="margin: 5px 0; color: #555;">Pay using your JazzCash Account.</p>
                        <br>
                        <br>
                        <?php if ($jobApplication['payment_mode'] != 'Card Payment' && $jobApplication['payment_mode'] != 'JazzCash Wallet'  && $jobApplication['payment_mode'] != 'Manual' && $jobApplication['payment_mode'] != 'OTC' ){ ?>
                        <a href="<?=base_url('job/payChallan/'.$jobApplication['unique_id'])?>" class="btn" style="background-color: #FF4500; color: white; border: none; border-radius: 5px; padding: 10px 20px; margin-top: 10px; cursor: pointer;">
                        Pay with JazzCash</a>
                        <?php }?>
                    </div>
                    
                    <div style="background-color: #fff; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); width: 300px; margin: 10px; padding: 20px; display: inline-block; vertical-align: top;">
                        <h3 style="margin: 0 0 10px; font-size: 18px; color: #333;">4. Pay & Upload Screenshot</h3>
                        <p style="margin: 5px 0; color: #555;"><strong style="color: #000;">Bank Name:</strong> Faysal Bank</p>
                        <p style="margin: 5px 0; color: #555;"><strong style="color: #000;">Account Title:</strong> Domestic Testing Services Pvt Ltd</p>
                        <p style="margin: 5px 0; color: #555;"><strong style="color: #000;">Account Number:</strong> PK61FAYS3459301000003492</p>
                        <?php if ($jobApplication['payment_mode'] != 'Card Payment' && $jobApplication['payment_mode'] != 'JazzCash Wallet'  && $jobApplication['payment_mode'] != 'Manual' ){ ?>
                        <a href="<?=base_url('job/challanUpdate/'.$jobApplication['unique_id'])?>" class="btn" style="background-color: #888; color: white; border: none; border-radius: 5px; padding: 10px 20px; margin-top: 10px; cursor: pointer;">
                        Manual Payment</a>
                        <?php }?>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>
