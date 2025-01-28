(function(api) {

  api.sectionConstructor['trovium-upsell'] = api.Section.extend({
      attachEvents: function() {},
      isContextuallyActive: function() {
          return true;
      }
  });

  const trovium_section_lists = ['banner', 'service'];
  trovium_section_lists.forEach(trovium_homepage_scroll);

  function trovium_homepage_scroll(item) {
      item = item.replace(/-/g, '_');
      wp.customize.section('trovium_' + item + '_section', function(section) {
          section.expanded.bind(function(isExpanding) {
              wp.customize.previewer.send(item, { expanded: isExpanding });
          });
      });
  }
})(wp.customize);