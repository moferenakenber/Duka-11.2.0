<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank vs PLC Comparator</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.6.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <style>
        .input-label { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px; display: block; opacity: 0.8; }
        .input-sm { height: 2.2rem; font-size: 0.9rem; }
        .flow-arrow { font-weight: 900; color: #10b980; margin: 0 4px; } /* Emerald-500 */
        .inline-result { font-size: 0.8rem; margin-top: 4px; color: #059669; font-weight: 600; } /* Emerald-600 */
        .plc-op-result { font-size: 0.8rem; margin-top: 4px; color: #064e3b; font-weight: 700; background-color: #f0fdf4; padding: 4px 8px; border-radius: 4px; } /* Emerald-900 on 50 */
    </style>
</head>
<body class="min-h-screen p-4 font-sans bg-base-200">

<div class="max-w-[1400px] mx-auto space-y-6">

    <div class="border-t-4 shadow-lg card bg-base-100 border-neutral">
        <div class="px-6 py-4 card-body">
            <h2 class="mb-2 text-lg card-title">1. Global Context & Starting Capital 🌍</h2>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-5">

                <div class="form-control">
                    <label class="input-label">Initial Investment (USD)</label>
                    <div class="join">
                        <span class="join-item btn btn-sm no-animation">$</span>
                        <input type="number" id="globalInvUSD" value="27800" class="w-full font-bold input input-sm input-bordered join-item" onchange="calculate()"/>
                    </div>
                     <span class="text-red-500 inline-result" id="calcStartBirr"></span>
                </div>

                <div class="form-control">
                    <label class="input-label">Initial FX (Birr/USD)</label>
                    <input type="number" id="globalFX" value="180" class="w-full input input-sm input-bordered" placeholder="180" onchange="calculate()"/>
                </div>

                <div class="form-control">
                    <label class="input-label">Duration (Years)</label>
                    <input type="number" id="globalYears" value="10" class="w-full input input-sm input-bordered" onchange="calculate()"/>
                </div>

                <div class="form-control">
                    <label class="input-label">Local Inflation (%)</label>
                    <input type="number" id="globalLocInf" value="28" class="w-full text-red-500 input input-sm input-bordered" onchange="calculate()"/>
                </div>

                <div class="form-control">
                    <label class="input-label">USD Inflation (%)</label>
                    <input type="number" id="globalUSDInf" value="3" class="w-full text-green-600 input input-sm input-bordered" onchange="calculate()"/>
                </div>

            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

        <div class="bg-white shadow-xl card">
            <div class="p-6 card-body">
                <div class="flex items-center gap-2 pb-2 mb-4 border-b">
                    <div class="badge badge-neutral badge-lg">A</div>
                    <h2 class="text-xl font-bold text-slate-700">Bank Investment (Baseline) 🏦</h2>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="input-label">Share Price (Birr)</label>
                        <input type="number" id="bankSharePrice" value="1000" class="w-full input input-sm input-bordered" onchange="calculate()"/>
                         <span class="inline-result" id="calcBankShares"></span>
                    </div>
                    <div>
                        <label class="input-label">Buying Commission (%)</label>
                        <input type="number" id="bankBuyComm" value="12" class="w-full input input-sm input-bordered" onchange="calculate()"/>
                         <span class="inline-result" id="calcBankInvested"></span>
                    </div>

                    <div class="col-span-2">
                        <label class="input-label">Annual EPS Yield (%)</label>
                        <input type="number" id="bankEPSYield" value="47" class="w-full font-bold input input-sm input-bordered text-primary" onchange="calculate()"/>
                        <div class="mt-1 text-xs text-gray-400">This yield is assumed to be fully reinvested annually.</div>
                    </div>
                </div>

                <div class="my-2 text-xs text-gray-400 divider">Exit Conditions</div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="input-label">Exit Appreciation (%)</label>
                        <input type="number" id="bankExitAppreciation" value="30" class="w-full input input-sm input-bordered" onchange="calculate()"/>
                    </div>
                     <div>
                        <label class="input-label">Exit Tax on Gain (%)</label>
                        <input type="number" id="bankExitTax" value="15" class="w-full input input-sm input-bordered" onchange="calculate()"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-xl card">
            <div class="p-6 card-body">
                <div class="flex items-center gap-2 pb-2 mb-4 border-b">
                    <div class="text-white badge badge-success badge-lg">B</div>
                    <h2 class="text-xl font-bold text-green-800">PLC (Company Investment) 🏭</h2>
                </div>

                <div class="grid grid-cols-3 gap-3 mb-4">
                    <div>
                        <label class="input-label">Share Price (Birr)</label>
                        <input type="number" id="plcSharePrice" value="1000" class="w-full input input-sm input-bordered" onchange="calculate()"/>
                        <span class="inline-result" id="calcPlcShares"></span>
                    </div>
                    <div>
                        <label class="input-label">Buy Comm (%)</label>
                        <input type="number" id="plcBuyComm" value="5" class="w-full input input-sm input-bordered" onchange="calculate()"/>
                         <span class="inline-result" id="calcPlcInvested"></span>
                    </div>
                     <div>
                        <label class="input-label">Total Shares Outstanding</label>
                        <input type="number" id="plcTotalShares" value="1000000" class="w-full input input-sm input-bordered" onchange="calculate()"/>
                    </div>
                </div>

                <div class="mb-4 form-control">
                    <label class="input-label">Company Stake (%)</label>
                    <input type="number" id="globalStake" value="100" class="w-full font-bold text-indigo-700 input input-sm input-bordered" placeholder="100" onchange="calculate()"/>
                    <div class="mt-1 text-xs text-gray-400">**Set to 100% per request.** Your share of company's net income.</div>
                </div>
                <div class="my-2 text-xs text-gray-400 divider">Operational Inputs & Unit Economics (Linear Flow)</div>

                <div class="grid grid-cols-3 gap-3">
                    <div class="form-control">
                        <label class="input-label">Pkgs / Day</label>
                        <input type="number" id="plcPkgsDay" value="500" class="w-full input input-sm input-bordered" onchange="calculate()"/>
                        <span class="plc-op-result" id="calcAnnualPkgs"></span>
                    </div>

                    <div class="form-control">
                        <label class="input-label">Price / Pkg (Birr)</label>
                        <input type="number" id="plcPricePkg" value="1100" class="w-full input input-sm input-bordered" onchange="calculate()"/>
                        <span class="plc-op-result" id="calcGrossRevDay"></span>
                    </div>

                    <div class="form-control">
                        <label class="font-extrabold text-red-600 input-label">Cost to Buy Good (Birr/Pkg)</label>
                        <input type="number" id="plcCOGS" value="400" class="w-full text-red-600 input input-sm input-bordered" onchange="calculate()"/>
                        <span class="text-red-800 plc-op-result bg-red-50" id="calcAfterCOGS"></span>
                    </div>
                    <div class="form-control">
                        <label class="input-label">Delivery Cost (Birr/Pkg)</label>
                        <input type="number" id="plcDelCost" value="100" class="w-full input input-sm input-bordered" onchange="calculate()"/>
                        <span class="plc-op-result" id="calcProfitAfterDel"></span>
                    </div>

                    <div class="form-control">
                        <label class="input-label">VAT (%)</label>
                        <input type="number" id="plcVAT" value="15" class="w-full input input-sm input-bordered" onchange="calculate()"/>
                        <span class="plc-op-result" id="calcProfitAfterVAT"></span>
                    </div>

                    <div class="form-control">
                        <label class="input-label">Import Duty (%)</label>
                        <input type="number" id="plcImportDuty" value="35" class="w-full input input-sm input-bordered" onchange="calculate()"/>
                        <span class="plc-op-result" id="calcProfitAfterDuty"></span>
                    </div>

                    <div class="form-control">
                        <label class="input-label">Transport & Insur. (%)</label>
                        <input type="number" id="plcTI" value="5" class="w-full input input-sm input-bordered" onchange="calculate()"/>
                        <span class="text-green-900 plc-op-result bg-success-content" id="calcNetProfitPkg"></span>
                    </div>
                </div>

                <div class="my-2 text-xs text-gray-400 divider">Financials (Taxes and Growth)</div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="input-label">Corp Tax (%)</label>
                        <input type="number" id="plcCorpTax" value="30" class="w-full input input-sm input-bordered" onchange="calculate()"/>
                        <span class="plc-op-result" id="calcNetIncDay"></span>
                    </div>
                    <div>
                        <label class="input-label">Reinvest Rate (%)</label>
                        <input type="number" id="plcReinvest" value="70" class="w-full input input-sm input-bordered" onchange="calculate()"/>
                        <span class="plc-op-result" id="calcNetIncYear"></span>
                    </div>
                    <div>
                        <label class="input-label">Div Tax (%)</label>
                        <input type="number" id="plcDivTax" value="15" class="w-full input input-sm input-bordered" onchange="calculate()"/>
                    </div>
                    <div>
                        <label class="input-label">Rev Growth (%)</label>
                        <input type="number" id="plcRevGrowth" value="-10" class="w-full text-lg font-bold text-red-600 input input-sm input-bordered" onchange="calculate()"/>
                        <div class="mt-1 text-xs text-gray-500">**Adjust this input** to match the Bank's True ROI.</div>
                    </div>
                     <div>
                        <label class="input-label">Cap Gains Tax (%)</label>
                        <input type="number" id="plcCGTax" value="15" class="w-full input input-sm input-bordered" onchange="calculate()"/>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <button onclick="calculate()" class="btn btn-primary btn-block text-xl shadow-lg transform hover:scale-[1.01] transition-all">
        Run 10-Year Projection 🚀
    </button>

    <div class="border-t-4 shadow-xl card bg-base-100 border-primary">
        <div class="p-6 card-body">
            <h3 class="flex items-center mb-3 text-lg font-bold text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                Calculation Flow Breakdown
            </h3>
            <div class="overflow-x-auto">
                <table class="table w-full table-zebra table-compact">
                    <thead>
                        <tr>
                            <th>Stage</th>
                            <th class="text-slate-700">Bank Investment (Baseline)</th>
                            <th class="text-green-700">PLC Investment (Company)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="font-bold">I. Entry (Year 0)</td>
                            <td class="text-sm">
                                **Start USD** <span class="flow-arrow">➡️</span> **Start Birr** <span class="flow-arrow">➡️</span> **-Commission** <span class="flow-arrow">➡️</span> **Shares Acquired**
                            </td>
                            <td class="text-sm">
                                **Start USD** <span class="flow-arrow">➡️</span> **Start Birr** <span class="flow-arrow">➡️</span> **-Commission** <span class="flow-arrow">➡️</span> **Shares Acquired**
                            </td>
                        </tr>
                        <tr>
                            <td class="font-bold">II. Annual Compounding</td>
                            <td class="text-sm">
                                **Shares** $\times$ **Share Price** $\times$ **Annual EPS Yield (47%)** <span class="flow-arrow">➡️</span> **Annual Return** <span class="flow-arrow">➡️</span> **Buy New Shares** <span class="flow-arrow">➡️</span> **Total Shares Compounded**
                            </td>
                            <td class="text-sm">
                                **Unit Profit** $\times$ **Pkgs/Year** $\to$ **Gross Profit** $\to$ **-Corp Tax** $\to$ **Net Income** $\to$ **Reinvest/Cash-Out** $\to$ **Buy New Shares** $\to$ **Total Shares & Dividends**
                            </td>
                        </tr>
                        <tr>
                            <td class="font-bold">III. Exit (Year 10)</td>
                            <td class="text-sm">
                                **End Shares** $\times$ **Share Price** $\times$ **Exit Apprec. (30%)** <span class="flow-arrow">➡️</span> **Sell Value** <span class="flow-arrow">➡️</span> **-Tax on Total Gain** <span class="flow-arrow">➡️</span> **Net Birr** $\to$ **Final FX Rate** $\to$ **Nominal USD** $\to$ **-USD Inflation** $\to$ **True ROI**
                            </td>
                            <td class="text-sm">
                                **End Shares** $\times$ **End Share Price** $\to$ **-Cap Gains Tax** <span class="flow-arrow">➡️</span> **Total Net Birr** (+ Dividends) $\to$ **Final FX Rate** $\to$ **Nominal USD** $\to$ **-USD Inflation** $\to$ **True ROI**
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <h2 class="mt-8 mb-4 text-2xl font-bold text-center">📈 Final Investment Outcomes (Year 10)</h2>
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

        <div class="border-l-8 shadow-xl card bg-base-100 border-neutral">
            <div class="card-body">
                <h3 class="font-bold text-gray-500 uppercase">Bank Outcome Summary 🏦</h3>

                <div class="w-full shadow stats stats-vertical lg:stats-horizontal">
                    <div class="stat place-items-center">
                        <div class="stat-title">Shares Owned (End)</div>
                        <div class="font-mono text-xl stat-value" id="resBankShares">0</div>
                        <div class="stat-desc">Nominal Birr Value: <span id="resBankEnd">0</span></div>
                    </div>
                    <div class="stat place-items-center">
                        <div class="stat-title">Final Value (Real USD)</div>
                        <div class="text-3xl font-black stat-value text-slate-800" id="resBankUSD">$0.00</div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="text-center alert bg-slate-100">
                        <div class="text-xs font-bold uppercase text-slate-500">Nominal ROI (Avg $/Yr)</div>
                        <div class="text-xl font-black text-slate-800" id="resBankNomROI">0%</div>
                    </div>
                     <div class="text-center alert bg-slate-200">
                        <div class="text-xs font-bold text-red-700 uppercase">True ROI (Real Avg $/Yr)</div>
                        <div class="text-xl font-black text-red-700" id="resBankTrueROI">0%</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-l-8 shadow-xl card bg-base-100 border-success">
             <div class="card-body">
                <h3 class="font-bold text-green-600 uppercase">PLC Outcome Summary 🏭</h3>

                <div class="w-full shadow stats stats-vertical lg:stats-horizontal">
                    <div class="stat place-items-center">
                        <div class="stat-title">Shares Owned (End)</div>
                        <div class="font-mono text-lg text-green-600 stat-value" id="resPlcShares">0</div>
                         <div class="stat-desc">Total Dividends: <span id="resPlcDivs">0</span> Birr</div>
                    </div>
                    <div class="stat place-items-center">
                        <div class="stat-title">Final Value (Real USD)</div>
                        <div class="text-3xl font-black text-green-700 stat-value" id="resPlcUSD">$0.00</div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="text-center alert bg-green-50">
                        <div class="text-xs font-bold text-green-600 uppercase">Nominal ROI (Avg $/Yr)</div>
                        <div class="text-xl font-black text-green-700" id="resPlcNomROI">0%</div>
                    </div>
                     <div class="text-center bg-green-100 alert">
                        <div class="text-xs font-bold text-green-800 uppercase">True ROI (Real Avg $/Yr)</div>
                        <div class="text-xl font-black text-green-800" id="resPlcTrueROI">0%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-4 bg-white shadow-xl card">
        <h3 class="mb-2 text-sm font-bold text-center text-gray-400">Nominal Birr Growth (Logarithmic Scale Recommended for High Inflation)</h3>
        <div class="h-[400px] w-full">
            <canvas id="mainChart"></canvas>
        </div>
    </div>

</div>

<script>
    let myChart;
    // Formatters: fmt (Birr large), fmtUSD, fmtInt (Birr integer)
    const fmt = new Intl.NumberFormat('en-US', { maximumFractionDigits: 2 });
    const fmtUSD = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' });
    const fmtInt = new Intl.NumberFormat('en-US', { maximumFractionDigits: 0 });

    /**
     * Calculates the Compound Annual Growth Rate (CAGR).
     */
    function calculateCAGR(start, end, years) {
        if (start <= 0 || years <= 0) return 0;
        return (Math.pow(end / start, 1 / years) - 1) * 100;
    }

    function calculate() {
        // --- GLOBAL INPUTS ---
        const startUSD = parseFloat(document.getElementById('globalInvUSD').value) || 0;
        const fxStart = parseFloat(document.getElementById('globalFX').value) || 1;
        const years = parseFloat(document.getElementById('globalYears').value) || 10;
        const locInf = parseFloat(document.getElementById('globalLocInf').value) / 100 || 0;
        const usdInf = parseFloat(document.getElementById('globalUSDInf').value) / 100 || 0;

        // --- BANK INPUTS ---
        const bankSharePrice = parseFloat(document.getElementById('bankSharePrice').value) || 1;
        const bankComm = parseFloat(document.getElementById('bankBuyComm').value) / 100 || 0;
        const bankEPSYield = parseFloat(document.getElementById('bankEPSYield').value) / 100 || 0;
        const bankExitAppreciation = parseFloat(document.getElementById('bankExitAppreciation').value) / 100 || 0;
        const bankExitTax = parseFloat(document.getElementById('bankExitTax').value) / 100 || 0;

        // --- PLC INPUTS ---
        const plcSharePrice = parseFloat(document.getElementById('plcSharePrice').value) || 1;
        const plcBuyComm = parseFloat(document.getElementById('plcBuyComm').value) / 100 || 0;
        const globalStake = parseFloat(document.getElementById('globalStake').value) / 100 || 0;

        // PLC Ops & Financials
        const pkgsDay = parseFloat(document.getElementById('plcPkgsDay').value) || 0;
        const pricePkg = parseFloat(document.getElementById('plcPricePkg').value) || 0;
        const cogsPkg = parseFloat(document.getElementById('plcCOGS').value) || 0; // NEW COGS INPUT
        const delCost = parseFloat(document.getElementById('plcDelCost').value) || 0;
        const vatRate = parseFloat(document.getElementById('plcVAT').value) / 100 || 0;
        const importDutyRate = parseFloat(document.getElementById('plcImportDuty').value) / 100 || 0;
        const tiRate = parseFloat(document.getElementById('plcTI').value) / 100 || 0;

        const corpTax = parseFloat(document.getElementById('plcCorpTax').value) / 100 || 0;
        const reinvest = parseFloat(document.getElementById('plcReinvest').value) / 100 || 0;
        const divTax = parseFloat(document.getElementById('plcDivTax').value) / 100 || 0;
        const revGrowth = parseFloat(document.getElementById('plcRevGrowth').value) / 100 || 0;
        const cgTax = parseFloat(document.getElementById('plcCGTax').value) / 100 || 0;

        // ==========================================
        // INITIAL SETUP & INLINE CALCULATIONS
        // ==========================================
        const startBirr = startUSD * fxStart;
        document.getElementById('calcStartBirr').innerText = `Total Birr: ${fmt.format(startBirr)}`;

        // --- BANK START: Buy Shares ---
        const bankInvestedBirr = startBirr * (1 - bankComm);
        const bankInitialShares = Math.floor(bankInvestedBirr / bankSharePrice);
        let bankShares = bankInitialShares;
        document.getElementById('calcBankInvested').innerText = `Invested: ${fmt.format(bankInvestedBirr)} Birr`;
        document.getElementById('calcBankShares').innerText = `Shares Purchased: ${fmtInt.format(bankInitialShares)}`;

        // --- PLC START: Buy Shares ---
        const plcInvestedBirr = startBirr * (1 - plcBuyComm);
        const plcInitialShares = Math.floor(plcInvestedBirr / plcSharePrice);
        let plcSharesOwned = plcInitialShares;
        let plcAccDivs = 0;
        document.getElementById('calcPlcInvested').innerText = `Invested: ${fmt.format(plcInvestedBirr)} Birr`;
        document.getElementById('calcPlcShares').innerText = `Shares Purchased: ${fmtInt.format(plcInitialShares)}`;


        // --- PLC OPERATIONAL METRICS (Year 0 Starting) ---
        const annualPkgs = pkgsDay * 365;
        document.getElementById('calcAnnualPkgs').innerText = `Pkgs/Year: ${fmtInt.format(annualPkgs)}`;

        // LINEAR PROFIT CALCULATION (Per Package) - CORRECTED FLOW

        let profit1 = pricePkg;
        document.getElementById('calcGrossRevDay').innerText = `Gross Rev/Day: ${fmt.format(pkgsDay * profit1)} Birr`;

        let profit2 = profit1 - cogsPkg; // After COGS (400 Birr)
        document.getElementById('calcAfterCOGS').innerText = `After COGS: ${fmt.format(profit2)} Birr/Pkg`;

        let profit3 = profit2 - delCost; // After Delivery Cost (100 Birr)
        document.getElementById('calcProfitAfterDel').innerText = `After Delivery: ${fmt.format(profit3)} Birr/Pkg`;

        let profit4 = profit3 * (1 - vatRate); // After VAT (15% of 600 Birr)
        document.getElementById('calcProfitAfterVAT').innerText = `After VAT: ${fmt.format(profit4)} Birr/Pkg`;

        let profit5 = profit4 * (1 - importDutyRate); // After Import Duty (35% of 510 Birr)
        document.getElementById('calcProfitAfterDuty').innerText = `After Duty: ${fmt.format(profit5)} Birr/Pkg`;

        let netProfitPerPkg = profit5 * (1 - tiRate); // After T&I (5% of 331.5 Birr)
        document.getElementById('calcNetProfitPkg').innerText = `Net Profit/Pkg: ${fmt.format(netProfitPerPkg)} Birr`;

        // Convert Unit Profit back to Daily/Annual Totals (for projection setup)
        const grossProfitDay = pkgsDay * netProfitPerPkg;
        const netIncDay = grossProfitDay * (1 - corpTax); // Net Income before Investor Stake

        // Net Income after Corporate Tax, proportional to Stake.
        const netIncYear = netIncDay * 365 * globalStake;

        document.getElementById('calcNetIncDay').innerText = `Net Inc/Day (After Corp Tax): ${fmt.format(netIncDay * globalStake)} Birr`;
        document.getElementById('calcNetIncYear').innerText = `Net Inc/Year (After Corp Tax): ${fmt.format(netIncYear)} Birr`;


        // ==========================================
        // PROJECTION LOOP
        // ==========================================
        let chartLabels = [];
        let bankData = [];
        let plcData = [];

        bankData.push(bankInvestedBirr);
        plcData.push(plcInvestedBirr);

        let curNetProfitPerPkg = netProfitPerPkg;
        let curPLCSharePrice = plcSharePrice;

        for(let i=1; i<=years; i++) {
            chartLabels.push(`Y${i}`);

            // --- BANK YEARLY ---
            const bankAnnualReturn = bankShares * bankSharePrice * bankEPSYield;
            const newShares = Math.floor(bankAnnualReturn / bankSharePrice);
            bankShares += newShares;
            const bankNominalVal = bankShares * bankSharePrice;
            bankData.push(bankNominalVal);


            // --- PLC YEARLY ---
            // Unit Profit is scaled up by Local Inflation (cost increases) AND Revenue Growth
            curNetProfitPerPkg = curNetProfitPerPkg * (1 + locInf) * (1 + revGrowth);

            let projectedGrossProfitYear = annualPkgs * curNetProfitPerPkg;
            let netIncomeYear = projectedGrossProfitYear * (1 - corpTax);
            let myIncome = netIncomeYear * globalStake;

            let taxedDiv = myIncome * (1 - divTax);
            let reinvestAmt = taxedDiv * reinvest;
            let cashOut = taxedDiv * (1 - reinvest);

            // Share Price appreciation is driven by a blend of local inflation and revenue growth
            // (Assuming share price tracks the growth in net income/assets)
            curPLCSharePrice = plcSharePrice * Math.pow(1 + locInf, i) * Math.pow(1 + revGrowth, i);
            let newSharesPLC = Math.floor(reinvestAmt / curPLCSharePrice);
            plcSharesOwned += newSharesPLC;
            plcAccDivs += cashOut;

            let plcVal = (plcSharesOwned * curPLCSharePrice) + plcAccDivs;
            plcData.push(plcVal);
        }

        // ==========================================
        // FINAL CONVERSIONS & EXIT CONDITIONS
        // ==========================================
        const finalFX = fxStart * Math.pow(1 + locInf, years);

        // --- BANK FINAL ---
        let bankSellValNominal = bankShares * bankSharePrice * (1 + bankExitAppreciation);
        let bankTotalGain = bankSellValNominal - bankInvestedBirr;
        let bankTax = bankTotalGain > 0 ? bankTotalGain * bankExitTax : 0;
        let bankNetBirr = bankSellValNominal - bankTax;

        let bankFinalUSD_Nominal = bankNetBirr / finalFX;
        let bankRealUSD = bankFinalUSD_Nominal / Math.pow(1 + usdInf, years);

        // --- PLC FINAL ---
        let plcSellVal = plcSharesOwned * curPLCSharePrice;
        let plcGain = plcSellVal - plcInvestedBirr;
        let plcTax = plcGain > 0 ? plcGain * cgTax : 0;
        let plcNetBirr = plcSellVal - plcTax + plcAccDivs;

        let plcFinalUSD_Nominal = plcNetBirr / finalFX;
        let plcRealUSD = plcFinalUSD_Nominal / Math.pow(1 + usdInf, years);

        // ==========================================
        // ANNUALIZED ROI CALCULATION
        // ==========================================
        const bankNominalCAGR = calculateCAGR(startUSD, bankFinalUSD_Nominal, years).toFixed(1);
        const bankRealCAGR = calculateCAGR(startUSD, bankRealUSD, years).toFixed(1);
        const plcNominalCAGR = calculateCAGR(startUSD, plcFinalUSD_Nominal, years).toFixed(1);
        const plcRealCAGR = calculateCAGR(startUSD, plcRealUSD, years).toFixed(1);

        // --- RENDER UI: SUMMARY SECTION ---

        // Bank
        document.getElementById('resBankShares').innerText = fmt.format(bankShares);
        document.getElementById('resBankEnd').innerText = fmt.format(bankNetBirr);
        document.getElementById('resBankUSD').innerText = fmtUSD.format(bankRealUSD);
        document.getElementById('resBankNomROI').innerText = `${bankNominalCAGR}%`;
        document.getElementById('resBankTrueROI').innerText = `${bankRealCAGR}%`;

        // PLC
        document.getElementById('resPlcShares').innerText = fmt.format(plcSharesOwned);
        document.getElementById('resPlcDivs').innerText = fmt.format(plcAccDivs);
        document.getElementById('resPlcUSD').innerText = fmtUSD.format(plcRealUSD);
        document.getElementById('resPlcNomROI').innerText = `${plcNominalCAGR}%`;
        document.getElementById('resPlcTrueROI').innerText = `${plcRealCAGR}%`;

        // Chart
        renderChart(chartLabels, bankData, plcData);
    }

    function renderChart(labels, bankData, plcData) {
        const ctx = document.getElementById('mainChart').getContext('2d');
        if(myChart) myChart.destroy();

        myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Bank (Nominal Birr)',
                        data: bankData,
                        borderColor: '#94a3b8',
                        backgroundColor: 'rgba(148, 163, 184, 0.1)',
                        fill: true,
                        tension: 0.3
                    },
                    {
                        label: 'PLC (Nominal Birr)',
                        data: plcData,
                        borderColor: '#22c55e',
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        fill: true,
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('en-US', {notation: "compact"});
                            }
                        }
                    }
                }
            }
        });
    }

    // Auto Run on load and whenever inputs change
    window.addEventListener('load', calculate);
</script>

</body>
</html>
