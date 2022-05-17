function myFunction() {
    var copyText = document.getElementById("walletCode");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
    
    var tooltip = document.getElementById("myTooltip");
    tooltip.innerHTML = "Copied!";
  }
  
  function outFunc() {
    var tooltip = document.getElementById("myTooltip");
    tooltip.innerHTML = "Copied!";
  }


function myFunction1() {
    var copyText = document.getElementById("walletCode1");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
    
    var tooltip = document.getElementById("myTooltip1");
    tooltip.innerHTML = "Copied!";
  }
  
  function outFunc1() {
    var tooltip = document.getElementById("myTooltip1");
    tooltip.innerHTML = "Copied!";
  }

  function myFunction2() {
    var copyText = document.getElementById("walletCode2");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
    
    var tooltip = document.getElementById("myTooltip2");
    tooltip.innerHTML = "Copied!";
  }
  
  function outFunc2() {
    var tooltip = document.getElementById("myTooltip2");
    tooltip.innerHTML = "Copied!";
  }

  $('#ethModal').on('hidden.bs.modal', function (e) {
    
        var tooltip = document.getElementById("myTooltip");
        tooltip.innerText = "copy";
  })

  $('#btcModal').on('hidden.bs.modal', function (e) {
    
        var tooltip = document.getElementById("myTooltip1");
        tooltip.innerText = "copy";
  })

  $('#liteModal').on('hidden.bs.modal', function (e) {
    
        var tooltip = document.getElementById("myTooltip2");
        tooltip.innerText = "copy";
  })