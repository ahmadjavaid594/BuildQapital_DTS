<section class="panel">
  <div id="declarationCard" class="card mt-4 border-0 shadow">

    <div class="card-body p-4">
      <p class="fw-bold ps-4"> Declarations:</p>
      <p>
        I, <strong><u><span id="cardName"><?=set_value('name', $applicant['name'])?></span></u></strong>, having CNIC 
        <strong><u><span id="cardCnic"><?=set_value('cnic', $applicant['cnic'])?></span></u></strong>, and Phone No 
        <strong><u><span id="cardMobile"><?=set_value('mobile_no', $applicant['mobileno'])?></span></u></strong>, do hereby solemnly declare that:
      </p>
      <ol>
          <li>All the information provided by me is correct and true to the best of my knowledge.</li>
          <li>I have never been dismissed from any Government service.</li>
          <li>I have never been involved in any criminal activities.</li>
          <li>I agree with the examination policies (Biometric verification, lens matching, etc.).</li>
          <li>This declaration is for job recruitment purposes only.</li>
        </ol>
      <p class="mt-3"><strong>Note:</strong> If any information is found false, I will be liable for legal action.</p>
    </div>

  </div>
</section>
