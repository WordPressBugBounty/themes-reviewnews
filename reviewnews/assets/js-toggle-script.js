document.addEventListener("DOMContentLoaded", function() {
    const cookieName = window.AFTSiteModeCookie || "reviewnews-stored-site-mode";

    // Apply saved mode from localStorage on page load
    const savedMode = localStorage.getItem(cookieName);
    if (savedMode) {
        document.body.classList.remove("aft-dark-mode","aft-default-mode");
        document.body.classList.add(savedMode);

        // Sync cookie
        document.cookie = cookieName + "=" + savedMode + "; path=/; max-age=" + (7*24*60*60) + "; SameSite=Lax";
    }

    // Toggle button
    const btn = document.getElementById("aft-dark-light-mode-btn");
    if (!btn) return;

    function applyMode(mode) {
        document.body.classList.remove("aft-dark-mode","aft-default-mode");
        document.body.classList.add(mode);

        btn.classList.remove("aft-dark-mode","aft-default-mode");
        btn.classList.add(mode);

        btn.dataset.siteMode = mode;
    }

    btn.addEventListener("click", function(e){
        e.preventDefault();
        let current = btn.dataset.siteMode || "aft-default-mode";
        let next = (current === "aft-dark-mode") ? "aft-default-mode" : "aft-dark-mode";

        document.cookie = cookieName + "=" + next + "; path=/; max-age=" + (7*24*60*60) + "; SameSite=Lax";
        localStorage.setItem(cookieName, next);

        applyMode(next);
    });
});
