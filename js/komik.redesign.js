(() => {
	var t = jQuery,
		e = document.getElementsByClassName('komiklist_overlay')[0],
		n = [
			document.getElementsByClassName('komiklist_dropdown-toggle genre')[0],
			document.getElementsByClassName('komiklist_dropdown-toggle status')[0],
			document.getElementsByClassName('komiklist_dropdown-toggle type')[0],
			document.getElementsByClassName('komiklist_dropdown-toggle sort_by')[0],
		];
	n &&
		e &&
		(n.forEach(function (t) {
			if (t) {
				var s = n.filter(function (e) {
					return e !== t;
				});
				t.addEventListener('click', function () {
					s.forEach(function (t) {
						t && t.classList.remove('open');
					}),
						t.classList.contains('open')
							? (t.classList.remove('open'), e.classList.remove('active'))
							: (t.classList.add('open'), e.classList.add('active'));
				});
			}
		}),
		e.addEventListener('click', function () {
			e.classList.remove('active'),
				n.forEach(function (t) {
					t.classList.remove('open');
				});
		}));
	var a,
		c = document.getElementsByClassName('slider round')[0],
		o = document.getElementsByTagName('body')[0];
	c &&
		c.addEventListener('click', function () {
			o.classList.contains('darkmode')
				? (o.classList.remove('darkmode'),
				  localStorage.removeItem('theme-mode'))
				: o.classList.add('darkmode');
		});
	var i = document.getElementById('search-ajax-result-wrapper'),
		l = document.getElementById('content'),
		d = document.getElementById('main-menu'),
		r = document.getElementsByClassName('th')[0],
		m = [i, l, d, r],
		u = t('.searchx #form #s').outerWidth();
	m.forEach(function (t) {
		t.addEventListener('click', function () {
			i.classList.add('hidden');
		});
	}),
		document
			.getElementsByClassName('search-live')[0]
			.addEventListener('input', function (e) {
				clearTimeout(a),
					(a = setTimeout(function () {
						t.ajax({
							url: '/wp-admin/admin-ajax.php',
							type: 'POST',
							data: {
								action: 'searchkomik_komikcast_redesign',
								search: s.value,
								orderby: 'relevance',
								per_page: 25,
							},
							success: function (e) {
								t('#search-ajax-result').empty(),
									e &&
										((e = JSON.parse(e)),
										i.classList.remove('hidden'),
										(i.style.width = ''.concat(u, 'px')),
										e.forEach(function (t) {
											var e = t.genres.map(function (t) {
													return t.name;
												}),
												s = '\n\t\t\t\t\t\t\t<a href="'
													.concat(
														t.permalink,
														'">\n\t\t\t\t\t\t\t\t<div class="post-thumbnail" style="flex: 0 0 20%;min-width: 4rem;">\n\t\t\t\t\t\t\t\t\t'
													)
													.concat(
														t.thumbnail,
														'\t\n\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t<div class="info" style="flex: 0 0 80%;">\n\t\t\t\t\t\t\t\t\t\t<span class="title">'
													)
													.concat(
														t.title,
														'</span>\n\t\t\t\t\t\t\t\t\t\t<span class="category">'
													)
													.concat(
														e.join(', '),
														'</span>\n\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t</a>\n\t\t\t\t\t\t'
													),
												n = document.createElement('li');
											n.classList.add('live-search_lnk'),
												n.classList.add('live-search_item'),
												(n.innerHTML = s),
												document
													.getElementById('search-ajax-result')
													.appendChild(n);
										}));
							},
						});
					}, 500));
			});
	var p = document.querySelectorAll('.list-update_item'),
		v = document.querySelector('.list-update_items-wrapper');
	p && p.length < 6 && v && v.classList.add('min6class');
})();
