<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Investment & EPS Calculator</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
body { font-family: Arial, sans-serif; margin:0; padding:0; }
.container { display: flex; flex-wrap: wrap; width: 100vw; height: 100vh; box-sizing: border-box; }
.left, .right { padding: 10px; box-sizing: border-box; }
.left { width: 50%; overflow-y: auto; }
.right { width: 50%; display: flex; flex-direction: column; justify-content: space-between; }
input, select, button { margin:2px 0; padding:2px; font-size:12px; width:100%; box-sizing:border-box;}
button { cursor:pointer; }
.output { background:#f3f3f3; padding:5px; border-radius:5px; font-size:12px; height:150px; overflow:auto;}
canvas { max-width:100%; max-height:300px;}
label { display:block; font-size:12px; margin-top:2px;}
</style>
</head>
<body>

<div class="container">
<div class="left">
<h2>Inputs</h2>
<label>Company Template:
<select id="companySelect" onchange="loadCompany()">
    <option value="custom">Custom Company</option>
    <option value="Belhab">Belhab Co.</option>
    <option value="ABC">ABC Corp</option>
</select></label>

<label>Company Name:<input type="text" id="companyName" value="Custom Company"></label>
<label>Investment Amount (Birr):<input type="number" id="investment" value="100000"></label>
<label>Share Percentage (%):<input type="number" id="sharePct" value="10"></label>
<label>Buy Commission (%):<input type="number" id="buyComm" value="1"></label>
<label>Sell Commission (%):<input type="number" id="sellComm" value="1"></label>
<label>EPS per Year (Birr):<input type="number" id="eps" value="5000"></label>
<label>EPS Tax (%):<input type="number" id="epsTax" value="0"></label>
<label>EPS Reinvestment (%):<input type="number" id="reinvestPct" value="50"></label>
<label>Reinvestment Tax (%):<input type="number" id="reinvestTax" value="0"></label>
<label>Sale Price per Share (Birr):<input type="number" id="salePrice" value="120000"></label>
<label>Capital Gains Tax (%):<input type="number" id="capGainsTax" value="15"></label>
<label>Investment Years:<input type="number" id="years" value="5"></label>

<h2>Currency & Inflation</h2>
<label>USD/Birr Rate at Purchase:<input type="number" id="usdRateBuy" value="55"></label>
<label>USD/Birr Rate at End:<input type="number" id="usdRateEnd" value="60"></label>
<label>Local Inflation (%/year):<input type="number" id="localInflation" value="28"></label>
<label>USD Inflation (%/year):<input type="number" id="usdInflation" value="3"></label>
<label>USD Fees (%):<input type="number" id="usdFees" value="1"></label>

<button onclick="calculate()">Calculate</button>
</div>

<div class="right">
<div class="output" id="results"></div>
<canvas id="growthChart"></canvas>
</div>
</div>

<script>
const templates = {
    Belhab:{companyName:"Belhab Co.", eps:5000, buyComm:1, sellComm:1, epsTax:0, reinvestPct:50, reinvestTax:0, capGainsTax:15},
    ABC:{companyName:"ABC Corp", eps:8000, buyComm:0.5, sellComm:0.5, epsTax:10, reinvestPct:40, reinvestTax:5, capGainsTax:15}
};

function loadCompany(){
    const sel = document.getElementById('companySelect').value;
    if(sel==='custom') return;
    const tpl = templates[sel];
    document.getElementById('companyName').value=tpl.companyName;
    document.getElementById('eps').value=tpl.eps;
    document.getElementById('buyComm').value=tpl.buyComm;
    document.getElementById('sellComm').value=tpl.sellComm;
    document.getElementById('epsTax').value=tpl.epsTax;
    document.getElementById('reinvestPct').value=tpl.reinvestPct;
    document.getElementById('reinvestTax').value=tpl.reinvestTax;
    document.getElementById('capGainsTax').value=tpl.capGainsTax;
}

function calculate(){
    const investment=parseFloat(document.getElementById('investment').value);
    const sharePct=parseFloat(document.getElementById('sharePct').value)/100;
    const buyComm=parseFloat(document.getElementById('buyComm').value)/100;
    const sellComm=parseFloat(document.getElementById('sellComm').value)/100;
    const eps=parseFloat(document.getElementById('eps').value);
    const epsTax=parseFloat(document.getElementById('epsTax').value)/100;
    const reinvestPct=parseFloat(document.getElementById('reinvestPct').value)/100;
    const reinvestTax=parseFloat(document.getElementById('reinvestTax').value)/100;
    const salePrice=parseFloat(document.getElementById('salePrice').value);
    const capGainsTax=parseFloat(document.getElementById('capGainsTax').value)/100;
    const years=parseInt(document.getElementById('years').value);

    const localInflation=parseFloat(document.getElementById('localInflation').value)/100;
    const usdInflation=parseFloat(document.getElementById('usdInflation').value)/100;
    const usdRateEnd=parseFloat(document.getElementById('usdRateEnd').value);
    const usdFees=parseFloat(document.getElementById('usdFees').value)/100;

    let invested=investment*(1-buyComm);
    let yearlyValue=[], reinvestedValue=0, totalCashOut=0;

    for(let i=1;i<=years;i++){
        let yearlyEPS=eps*sharePct;
        let epsCashOut=yearlyEPS*(1-epsTax)*(1-reinvestPct);
        let epsReinvested=yearlyEPS*reinvestPct*(1-reinvestTax);
        reinvestedValue=(reinvestedValue+epsReinvested)*(1+0);
        totalCashOut+=epsCashOut;
        yearlyValue.push(totalCashOut+reinvestedValue);
    }

    let saleValue=salePrice*sharePct*(1-sellComm);
    let capitalGain=saleValue-invested;
    let afterCapGains=saleValue-(capitalGain*capGainsTax);

    let realValue=afterCapGains;
    for(let i=0;i<years;i++) realValue/=(1+localInflation);

    let inUSD=(realValue/usdRateEnd)*(1-usdFees);

    document.getElementById('results').innerHTML=`
    <strong>Final Sale Value (Birr):</strong> ${afterCapGains.toFixed(2)}<br>
    <strong>Real Value after Local Inflation:</strong> ${realValue.toFixed(2)}<br>
    <strong>Equivalent in USD:</strong> ${inUSD.toFixed(2)}<br>
    <strong>Total Cash-Out from EPS:</strong> ${totalCashOut.toFixed(2)}<br>
    <strong>Total Reinvested Value:</strong> ${reinvestedValue.toFixed(2)}
    `;

    const ctx=document.getElementById('growthChart').getContext('2d');
    if(window.chartInstance) window.chartInstance.destroy();
    window.chartInstance=new Chart(ctx,{
        type:'line',
        data:{labels:Array.from({length:years},(_,i)=>`Year ${i+1}`), datasets:[{label:'Investment Growth',data:yearlyValue,borderColor:'blue',fill:false}]},
        options:{responsive:true,plugins:{legend:{display:true}},maintainAspectRatio:false}
    });
}
</script>

</body>
</html>
