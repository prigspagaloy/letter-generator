const logo = document.querySelector(".logo-container");
const sidebar = document.querySelectorAll(".side-navbar-menu");
const htmlFileUrl = 'dashboard-content.html';
const targetDivId = "content";
const content = document.getElementById("content");

logo.addEventListener("click", () => {
    window.location.href = "/letter-generator";
})

const urlRoutes = {
	"dashboard": {
		template: "dashboard-content.html",
	},
	"documents": {
		template: "documents.html",
	},
	"templates": {
		template: "templates.html",
	},
	"authorization": {
		template: "authorization.html",
	},
	"contracts": {
		template: "contracts.html",
	},
	"correspondence": {
		template: "correspondence.html",
	},
	"client": {
		template: "client.html",
	},
	"branding": {
		template: "branding.html",
	},
};

const urlPath = window.location.pathname;

if (urlPath == "/letter-generator/pages/dashboard.html") {
		fetchHtmlContent("dashboard-content.html")
	}

sidebar.forEach(btn => {
  btn.addEventListener("click", (e) => {
	let urlFile;
	if (urlRoutes[e.target.id]) {
		urlFile = urlRoutes[e.target.id].template;
	} else if (urlRoutes[e.target.parentNode.id]) {
		urlFile = urlRoutes[e.target.parentNode.id].template;
	}

	fetchHtmlContent(urlFile);
	e.preventDefault();
  })
})

function fetchHtmlContent(url) {
    fetch(url)
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.text(); // Get the response body as text (HTML content)
      })
      .then(htmlContent => {
        // const targetElement = document.getElementById(targetElementId);
        if (content) {
          content.innerHTML = htmlContent;
        } else {
          console.error(`Target element with ID '${targetElementId}' not found.`);
        }
      })
      .catch(error => {
        console.error('Error fetching HTML:', error);
      });
  }