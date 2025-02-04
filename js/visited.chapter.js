const visitedChapters = JSON.parse(localStorage.getItem("visited-chapters"));
let e = [];
const t = document.getElementById("chapter-wrapper");
let i = "";

if (!visitedChapters || visitedChapters.length === 0) {
	e = chapters;
	console.log("initial visit", e);
	e.forEach((e) => {
		e.visited
			? (i += `\n                <li class="komik_info-chapters-item visited">\n                    <a class="chapter-link-item" href="${e.link}">Chapter\n                    ${e.chapter}\n                    </a>\n                    <div class="chapter-link-time">\n                    ${e.update} ago.\n                    </div>\n                </li>\n                `)
			: (i += `\n            <li class="komik_info-chapters-item">\n                <a class="chapter-link-item" href="${e.link}">Chapter\n                ${e.chapter}\n                </a>\n                <div class="chapter-link-time">\n                ${e.update} ago.\n                </div>\n            </li>\n            `);
	});
	t.innerHTML = i;
} else {
	function findID(e) {
		return visitedChapters.filter((t) => t === e);
	}
	e = chapters.map((e, t) =>
		findID(e.id).length > 0 ? { ...e, visited: !0 } : e
	);
	e.forEach((e) => {
		e.visited
			? (i += `\n                <li class="komik_info-chapters-item visited">\n                    <a class="chapter-link-item" href="${e.link}">Chapter\n                    ${e.chapter}\n                    </a>\n                    <div class="chapter-link-time">\n                    ${e.update} ago.\n                    </div>\n                </li>\n                `)
			: (i += `\n            <li class="komik_info-chapters-item">\n                <a class="chapter-link-item" href="${e.link}">Chapter\n                ${e.chapter}\n                </a>\n                <div class="chapter-link-time">\n                ${e.update} ago.\n                </div>\n            </li>\n            `);
	});
	t.innerHTML = i;
}
