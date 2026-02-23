# Barzza Custom Tabs Plugin

A lightweight WordPress plugin that converts your existing posts into dynamic tabs. Uses your posts with the "standalone" category to create tabbed content.

## Features

- **Uses Existing Posts**: Queries posts from your "standalone" category
- **No New Admin Section**: Uses your existing posts and categories
- **Custom HTML Support**: Full HTML editor support in post content
- **Flexible Ordering**: Order tabs by title, date, or menu order
- **Responsive Design**: Mobile-friendly tabs that adapt to all screen sizes
- **Keyboard Navigation**: Arrow keys support for accessibility
- **Shortcode Ready**: Simple shortcode for displaying tabs anywhere

## Installation

1. Upload the `barzza-custom-tabs` folder to `/wp-content/plugins/`
2. Activate the plugin from the WordPress Plugins page
3. That's it! Use the shortcode below to display your standalone posts as tabs

## Usage

### Setting Up Your Posts as Tabs

1. Navigate to **Posts** in the WordPress admin
2. Create or edit posts you want as tabs
3. Assign the **"standalone"** category to each post
4. The post title becomes the tab name
5. The post content becomes the tab body (HTML supported)
6. Publish

### Displaying Tabs on Your Site

Add the shortcode to any page or post:

```
[barzza_tabs]
```

### Shortcode Options

You can customize the tabs using shortcode parameters:

```
[barzza_tabs category="standalone" orderby="title" order="ASC"]
```

**Available Parameters:**
- `category` - Category slug (default: "standalone")
- `orderby` - Order posts by: `title`, `date`, or `menu_order` (default: "title")
- `order` - Sort order: `ASC` or `DESC` (default: "ASC")

### Pro Tips

- Use **Tab Order** to control the sequence of tabs (e.g., 1, 2, 3...)
- You can include images, forms, custom HTML, and shortcodes in tab content
- Tabs are responsive and work great on mobile devices
- The first tab is automatically active/open

## Styling

The plugin uses the color `#0c8ce9` (your theme's primary blue) for active tab indicators. To customize colors, edit `/assets/css/tabs.css` or add custom CSS in your theme's `style.css`:

```css
.barzza-tab-button.active {
	color: #your-color;
}

.barzza-tabs-nav {
	border-bottom-color: #your-color;
}
```

## Accessibility

- ARIA labels for screen readers
- Keyboard navigation support (arrow keys)
- Proper tab panel roles and labeling

## Support

For questions or issues, contact your developer.

---

**Version**: 1.0.0  
**Author**: Barzza  
**License**: GPL v2 or later
