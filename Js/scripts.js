const sortSelect = document.getElementById("sortSelect");
if (sortSelect) {
  sortSelect.addEventListener("change", function () {
    const [sort, order] = sortSelect.value.split("_");
    const urlSearchParams = new URLSearchParams(window.location.search);
    urlSearchParams.set("sort", sort);
    urlSearchParams.set("order", order);
    window.location.search = urlSearchParams.toString();
  });
}

const APP_ID = "2a6ed835dc0d45b4a340b58ab81f91b5";

let rates = null;

const amountEl = document.getElementById("amount");
const currencyEl = document.getElementById("currency");
const resultEl = document.getElementById("conversion-result");

async function fetchRates() {
  try {
    const response = await fetch(
      `https://openexchangerates.org/api/latest.json?app_id=${APP_ID}`,
    );

    const data = await response.json();

    rates = data.rates;

    calculate();
  } catch (error) {
    resultEl.textContent = "Kunde inte hämta valutakurser.";
    console.error(error);
  }
}

function calculate() {
  if (!rates) return;

  const sek = parseFloat(amountEl.value);
  const currency = currencyEl.value;

  if (currency === "SEK") {
    resultEl.textContent = `${sek.toFixed(2)} SEK`;
    return;
  }

  const converted = sek * (rates[currency] / rates["SEK"]);

  resultEl.textContent = `${converted.toFixed(2)} ${currency}`;
}

currencyEl.addEventListener("change", calculate);

fetchRates();
