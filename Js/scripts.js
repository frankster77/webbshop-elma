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
