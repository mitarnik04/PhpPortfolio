# PhpPortfolio

[![BuildStatus](https://github.com/mitarnik04/PhpPortfolio/actions/workflows/build.yaml/badge.svg)](https://github.com/mitarnik04/PhpPortfolio/actions/workflows/build.yaml)
![License](https://img.shields.io/badge/license-CDDL-blue.svg)
![PHP Version](https://img.shields.io/badge/php-8.0%2B-blue)

A modern, dynamically extensible PHP portfolio application.

This project demonstrates my approach to building scalable and maintainable web applications in PHP, emphasizing clean architecture and modular design.

---

## Table of Contents

1. [Project Overview](#project-overview)
2. [Key Features](#key-features)
3. [Installation](#installation)
4. [Usage](#usage)
5. [Directory Structure](#directory-structure)
6. [Architecture and Concepts](#architecture-and-concepts)
7. [Extending & Customizing](#extending--customizing)
8. [License](#license)
9. [Updates](#updates)

---

## Project Overview

This application is designed for clean presentation, professionalism, and easy extensibility. Its primary purpose is to provide a flexible platform for showcasing experience, projects, and providing a way for potential clients or fellow developers to get in contact. Additionally, it reflects a conscious decision to implement core functionalities manually, enhancing my understanding of PHP's capabilities.

**Why not use pre-made libraries?**

To...

- deepen my understanding of PHP, since it’s not my primary language.
- challenge myself by building everything manually (excluding PHPMailer for secure email).
- gain full control over the architecture and avoid dependencies on external frameworks or packages.
- test my engineering discipline: building a robust, maintainable system with little to no external dependencies.

---

## Key Features

- **Dynamic, File-Driven Navigation**:  
  Pages are added simply by creating a new file; navigation is automatically updated. Display order and icons are managed via a JSON configuration (`/components/nav-bar/configs/page-config.json`).
- **Multi-Language Support**:  
  Instantly adds languages through translation files. All UI and content update according to the user's language preference.
- **Component-Based UI**:  
  Navigation, cards, pop-ups, language toggler, and other interface elements are modular, reusable, and easily extensible.
- **Secure Contact System**:  
  Contact forms include server-side and client-side validation. Emails use template-driven, tokenized messaging via a Mailer class build on top of PHPMailer. Credentials are configurable.
- **Simple Configuration**:  
  Project structure and configuration are separated for easy scalability and adaptation to new requirements.
- **Framework-Free Philosophy**:  
  The application is built from the ground up, with PHPMailer as the sole external dependency for secure email handling.

---

## Installation

### Prerequisites

- **PHP** 8.0+
- **Web server** such as Apache or Nginx
- **SMTP credentials** (required for contact email functionality)

### Setup Steps

1. **Clone the repository:**

   ```bash
   git clone https://github.com/mitarnik04/PhpPortfolio.git
   cd portfolio
   ```

2. **Configure Mail/SMTP:**

   - Create a `mail/mail-config.json` file.

   - Copy the contents of `mail/mail-config(empty).json` into your file, then update it with your credentials.

   It should look something like this:

   ```json
   {
     "USERNAME": "your-smtp-user@gmail.com",
     "PASSWORD": "your-app-password",
     "SENDER_MAIL": "no-reply@yourdomain.com"
   }
   ```

   _PHPMailer is included in the `mail/phpMailer` directory. For updates or customization, it can be managed via Composer._

3. **Configure Web Server:**  
   Point the document root at the project root. The application is initialized via `index.php` and `core.php`.

4. **Access the Application:**  
   Open `http://localhost:[YOUR CONFIGURED PORT]` or your deployed domain in a browser and you will land on the homepage by default (`views/home.php`).

---

## Usage

- **Professional Presentation:**  
  Edit or add pages, update `page-config.json` and see immediate updates in navigation and UI.
- **Effortless Language Switching:**  
  New languages appear immediately when a translation JSON is added; users can switch at any time. _No need to update the php code at all._
- **Contact Form:**  
  Provides validation with clear error/success feedback and sends formatted, secure emails.
- **Clean Engineering:**  
  The structure facilitates real-world maintainability and scalability.

---

## Directory Structure

```
portfolio/
├── .github/               # GitHub configuration files
│   └── workflows/         # GitHub Actions workflows (CI/CD pipelines)
├── components/            # Modular UI (card, nav-bar, pop-up, language-toggle)
│   ├── card/
│   ├── language-toggle/
│   ├── nav-bar/
│   │   └── configs/        # page-config.json: nav order/icons
│   └── pop-up/
├── core.php               # App orchestrator/entry-point
├── dependencies.php
├── helpers/               # Util: dynamic discovery, translation, etc.
│   ├── container.php
│   ├── metadata.php
│   ├── timespan.php
│   ├── translation.php
│   └── utils.php
├── index.php
├── mail/
│   ├── mail-config.json
│   ├── mail-information.php
│   ├── mail-template.php
│   ├── mailer.php
│   ├── phpMailer/
│   └── templates/
│       └── contact-mail-template.php
├── public/
│   ├── images/
│   ├── js/
│   └── styles/
├── tests/                 # Contains a quick and easy way to set-up tests, that can be run as part of the deploy process.
├── translations/          # Translation files: de.json, en.json, etc.
├── user-settings.php
├── validators/
│   ├── contact-validator.php
│   └── validator.php
└── views/                 # Each .php = a routable SPA page
    ├── contact.php
    ├── home.php
    ├── languages.php
    └── work-experience.php
```

For insight on how to add pages, languages, etc., see: [Extending & Customizing](#extending--customizing).

---

## Architecture and Concepts

### Dynamic Navigation & Routing

- Any file in `views/` is automatically available as a routable SPA page.
- Navigation structure and icons are defined in `components/nav-bar/configs/page-config.json`.
- No hardcoding paths; all files are auto-discovered.

### Multi-Language System

- One translation JSON per language, placed in `translations/`.
- Language selector UI dynamically lists available languages.

### Modular Component System

- All major UI fragments implement a common interface for plug-and-play extensibility (IComponent).
- Custom components or layout changes can be implemented with minimal modifications.

### Validation & Mailing

- Forms are validated on both client and server side.
  - For server-side validations each form has a corresponding validator in `validators/`
- The mail sending is based on tokenized mail templates in `mail/templates/`.
- Secure mail sending uses the Mailer class build on top of PHPMailer, with credentials externalized in the config (`mail-config.json`).

### User Experience

- Features like active-page highlighting, icons, and pop-ups are configuration-driven.
- Responsive design ensures a seamless user experience across various devices and screen sizes.

### Handcrafted Approach

A core philosophy of this project is to minimize external dependencies and build every piece of functionality from the ground up. From routing, navigation, and dynamic discovery to validation and rendering.

This approach prioritizes:

- Deepening my knowledge of PHP’s language features and standard library.

- Achieving precise control over architecture and performance.

- Eliminating vendor lock-in and ensuring long-term flexibility.

While this approach is more labor-intensive and doesn’t leverage the reliability of pre-tested libraries along with the convenience of Composer, it’s a deliberate choice to prioritize understanding and experimentation. The payoff is full control over every aspect of the application and the ability to shape it exactly as I envision.

## Extending & Customizing

- **Add a Page:** Place a `.php` file in `views/` and configure it in `nav-bar/configs/page-config.json`.

> [!Important]
> Ensure that the JSON key in `page-config.json` matches the view filename.

For each language file in `translations/`, add a corresponding key in the `SPA_SETUP` section to specify the navigation label.

**Example of the `SPA_SETUP` section in the translation file**  
 _(Keys must match the corresponding view filenames without the `.php` extension)_

```json
{
  "SPA_SETUP": {
    "HOME": "Home",
    "CONTACT": "Contact",
    "[YOUR_VIEW_FILENAME]": "[Displayed text in navigation bar]"
  }
}
```

- **Add a Language:** Add a new `{lang}.json` file to the `translations/` directory..
- **Customize Navigation**: Edit `page-config.json` to update order and icons.
- **UI or Validation Extensions**: Write new components (implement the required interface) or validators, and add mail templates as needed.  
  Mail templates are written in a custom file type (.tpl), which is basically HTML with tokens.

---

## License

This project is released under the [CDDL License](LICENSE).
You are free to use, modify, and share under these terms.

---

## Updates

The README is updated regularly to match new features and code changes. If you notice outdated information, rest assured it will be refreshed as soon as possible.

---

**Thank you for your interest in this project! Feel free to contact me with any questions or for technical discussions.**
