function filterOnDemand() {
    const select = document.getElementById('filter');
        switch (select.selectedIndex) {
            case 1:
                filterWork(document.querySelector("table"), 7, true);
                break;
            case 2:
                filterWork(document.querySelector("table"), 7, false);
                break;
        }
    }


function filterWork(table, column, asc) {
    const dirModifier = asc ? 1 : -1;
    const tbody = table.tBodies[0];
    const rows = Array.from(tbody.querySelectorAll("tr"));
    const sortedRows = rows.sort((a, b) => {
        const aContent = parseFloat(a.querySelector(`td:nth-child(${column + 1})`).textContent.trim());
        const bContent = parseFloat(b.querySelector(`td:nth-child(${column + 1})`).textContent.trim());
        return aContent > bContent ?  (dirModifier * 1) : (dirModifier * -1);
    });

    // Removing
    while (tbody.firstChild) {
        tbody.removeChild(tbody.firstChild);
    }

    // Appending
    tbody.append(...sortedRows);
}

