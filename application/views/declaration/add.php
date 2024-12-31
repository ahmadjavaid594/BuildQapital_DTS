<section class="panel">
  <div id="declarationCard" class="card mt-4 border-0 shadow">

   <div class="card-body p-4" style="padding: 20px;">
  <p class="fw-bold ps-4" style="padding-left: 20px;">Declarations:</p>
  <p style="padding: 10px;">
    I, <strong><u><span id="cardName" style="padding: 5px;"><?=set_value('name', $applicant['name'])?></span></u></strong>, having CNIC 
    <strong><u><span id="cardCnic" style="padding: 5px;"><?=set_value('cnic', $applicant['cnic'])?></span></u></strong>, and Phone No 
    <strong><u><span id="cardMobile" style="padding: 5px;"><?=set_value('mobile_no', $applicant['mobileno'])?></span></u></strong>, do hereby solemnly declare that:
  </p>
  <ol style="padding-left: 40px;">
    <li style="padding: 5px;">All the information provided by me is correct and true to the best of my knowledge.</li>
    <li style="padding: 5px;">I have never been dismissed from any Government service.</li>
    <li style="padding: 5px;">I have never been involved in any criminal activities.</li>
    <li style="padding: 5px;">I agree with the examination policies (Biometric verification, lens matching, etc.).</li>
    <li style="padding: 5px;">This declaration is for job recruitment purposes only.</li>
  </ol>
  <p class="mt-3" style="padding: 10px;"><strong>Note:</strong> If any information is found false, I will be liable for legal action.</p>
</div>
  </div>
</section>
