# CF7 Radio Slider

A WordPress plugin that converts Contact Form 7 radio button groups into beautiful carousel sliders.

## Features

- Converts CF7 radio buttons into a carousel slider
- Navigate between options using next/previous arrows
- Dots indicator showing current slide
- Click-to-select options
- Automatically syncs with the hidden radio inputs
- Smooth animations and transitions
- Responsive design

## Installation

1. Upload the `cf7-radio-slider` folder to `/wp-content/plugins/`
2. Activate the plugin in WordPress admin
3. Configure your CF7 form (see usage below)

## Usage

To convert a CF7 radio button group into a slider, add the `cf7rs-target` class to your form tag:

```
[radio standalone class:cf7rs-target "Option 1" "Option 2" "Option 3"]
```

Or if you're using the UI builder in CF7, add this CSS class to the radio field:
```
cf7rs-target
```

## How It Works

1. The plugin detects radio groups with the `cf7rs-target` class
2. Creates a carousel slider with each option as a slide
3. Users navigate using:
   - Left/Right arrow buttons
   - Dot indicators at the bottom
   - Clicking on an option button
4. The selected value is stored in the hidden radio input
5. On form submission, the selected value is included

## Styling

The plugin uses WordPress admin color scheme by default. You can customize the colors by adding CSS to your theme:

```css
.cf7rs-radio-option {
    /* Your custom styles */
}

.cf7rs-radio-option.active {
    /* Active state styles */
}
```

## Requirements

- WordPress 5.0+
- Contact Form 7
- jQuery

## License

GPL v2 or later
