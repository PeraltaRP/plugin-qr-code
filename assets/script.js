jQuery(document).ready(function () {
  jQuery("#tags").autocomplete({
    source: availablePosts,
  });
});
