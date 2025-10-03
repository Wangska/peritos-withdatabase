document.addEventListener("DOMContentLoaded", function () {
    const rows = document.querySelectorAll("table tr");

    rows.forEach((row, index) => {
        if (index === 0) return; 

        const scoreCell = row.cells[2]; 
        const statusCell = row.cells[3]; 

        if (scoreCell && statusCell) {
            let score = parseInt(scoreCell.textContent.trim());

            if (score >= 10) {
                statusCell.textContent = "PASSED";
                statusCell.classList.add("passed");
                statusCell.classList.remove("failed");
            } else {
                statusCell.textContent = "FAILED";
                statusCell.classList.add("failed");
                statusCell.classList.remove("passed");
            }
        }
    });
});

