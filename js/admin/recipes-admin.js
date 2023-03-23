jQuery(function ($) {
	(function (e) {
		let a = e("#timestampmodifieddiv");
		a.siblings("a.edit-timestampmodified").click(function (i) {
			a.is(":hidden") &&
				(a.slideDown("fast", function () {
					e("input, select", a.find(".timestamp-wrap")).first().focus();
				}),
				e(this).hide()),
				i.preventDefault();
		}),
			a.find(".cancel-timestamp").click(function (t) {
				a.slideUp("fast").siblings("a.edit-timestampmodified").show().focus(),
					e("#mmm").val(e("#hidden_mmm").val()),
					e("#jjm").val(e("#hidden_jjm").val()),
					e("#aam").val(e("#hidden_aam").val()),
					e("#hhm").val(e("#hidden_hhm").val()),
					e("#mnm").val(e("#hidden_mnm").val()),
					i(),
					e("#wplmi-change-modified ").val("no"),
					t.preventDefault();
			}),
			a.find(".save-timestamp").click(function (t) {
				e("#wplmi-change-modified").val("yes"),
					i() &&
						(a.slideUp("fast"),
						a.siblings("a.edit-timestampmodified").show().focus()),
					t.preventDefault();
			}),
			e("#post").on("submit", function (t) {
				i() ||
					(t.preventDefault(),
					a.show(),
					wp.autosave && wp.autosave.enableButtons(),
					e("#publishing-action .spinner").removeClass("is-active"));
			});
		var i = function () {
			if (!a.length) return !0;
			var i = "%1$s %2$s, %3$s " + a.data("separator") + " %4$s:%5$s",
				t = e("#aam").val(),
				s = e("#mmm").val(),
				l = e("#jjm").val(),
				m = e("#hhm").val(),
				n = e("#mnm").val(),
				d = a.data("prefix"),
				p = new Date(t, s - 1, l, m, n);
			return p.getFullYear() != t ||
				1 + p.getMonth() != s ||
				p.getDate() != l ||
				p.getMinutes() != n
				? (a.find(".timestamp-wrap").addClass("form-invalid"), !1)
				: (a.find(".timestamp-wrap").removeClass("form-invalid"),
				  e("#wplmi-timestamp").html(
						"\n " +
							d +
							" <b>" +
							i
								.replace(
									"%1$s",
									e('option[value="' + s + '"]', "#mmm").attr("data-text")
								)
								.replace("%2$s", parseInt(l, 10))
								.replace("%3$s", t)
								.replace("%4$s", ("00" + m).slice(-2))
								.replace("%5$s", ("00" + n).slice(-2)) +
							"</b> "
				  ),
				  e("#wplmi-timestamp-be").html(
						"\n  <b>" +
							i
								.replace(
									"%1$s",
									e('option[value="' + s + '"]', "#mmm").attr("data-text")
								)
								.replace("%2$s", parseInt(l, 10))
								.replace("%3$s", t)
								.replace("%4$s", ("00" + m).slice(-2))
								.replace("%5$s", ("00" + n).slice(-2)) +
							"</b> "
				  ),
				  !0);
		};
		e("#wplmi_disable")
			.change(function () {
				e(this).is(":checked") && e("#wplmi-disable-hidden").val("yes"),
					e(this).is(":checked") || e("#wplmi-disable-hidden").val("no");
			})
			.change();
	})(jQuery);
});
