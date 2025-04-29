document.addEventListener("DOMContentLoaded", function() {
    // Toggle Dark Mode
    const darkModeToggle = document.createElement("button");
    darkModeToggle.innerText = localStorage.getItem("darkMode") === "true" ? "☀️ Light Mode" : "🌙 Dark Mode";
    darkModeToggle.classList.add("dark-mode-toggle");
    document.body.prepend(darkModeToggle);
    
    darkModeToggle.addEventListener("click", function() {
        document.body.classList.toggle("dark-mode");
        const isDarkMode = document.body.classList.contains("dark-mode");
        localStorage.setItem("darkMode", isDarkMode);
        darkModeToggle.innerText = isDarkMode ? "☀️ Light Mode" : "🌙 Dark Mode";
    });
    
    // Load Dark Mode preference
    if (localStorage.getItem("darkMode") === "true") {
        document.body.classList.add("dark-mode");
    }
    
    // Add hover effect to navigation links
    document.querySelectorAll("nav ul li a").forEach(link => {
        link.addEventListener("mouseover", () => link.style.color = "yellow");
        link.addEventListener("mouseout", () => link.style.color = "white");
    });
    
    // Form validation for contact page
    const contactForm = document.querySelector(".contact form");
    if (contactForm) {
        contactForm.addEventListener("submit", function(event) {
            const name = document.getElementById("name").value.trim();
            const email = document.getElementById("email").value.trim();
            const message = document.getElementById("message").value.trim();
            if (!name || !email || !message) {
                alert("Harap isi semua kolom formulir!");
                event.preventDefault();
            }
        });
    }
    
    // Copy code to clipboard on Programming page
    document.querySelectorAll("pre code").forEach(codeBlock => {
        const copyButton = document.createElement("button");
        copyButton.innerText = "📋 Salin Kode";
        copyButton.classList.add("copy-button");
        codeBlock.parentNode.insertBefore(copyButton, codeBlock);
        
        copyButton.addEventListener("click", function() {
            navigator.clipboard.writeText(codeBlock.innerText).then(() => {
                copyButton.innerText = "✅ Tersalin!";
                setTimeout(() => copyButton.innerText = "📋 Salin Kode", 2000);
            });
        });
    });

    // Smooth scroll to sections
    document.querySelectorAll("nav ul li a").forEach(anchor => {
        anchor.addEventListener("click", function(event) {
            if (this.getAttribute("href").startsWith("#")) {
                event.preventDefault();
                const targetSection = document.querySelector(this.getAttribute("href"));
                if (targetSection) {
                    targetSection.scrollIntoView({ behavior: "smooth" });
                }
            }
        });
    });
});