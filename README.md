# Portfolio Application

A modern, dynamically extensible PHP portfolio application.
This project showcases my technical skills, maintainability philosophy, and ability to craft scalable web solutions. It features multi-language support, dynamic navigation, a robust contact system, and modular, reusable components.

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

This application is designed for clean presentation, professionalism, and easy extensibility. Its primary purpose is to provide a flexible platform for showcasing experience, projects, and providing a way for potential clients or fellow developers to get in contact, while demonstrating modern PHP best practices and maintainable engineering.

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

   1. Update `mail/mail-config(empty).json` with your email credentials:

   ```json
   {
     "USERNAME": "your-smtp-user@gmail.com",
     "PASSWORD": "your-app-password",
     "SENDER_MAIL": "no-reply@yourdomain.com"
   }
   ```

   2. Remove the `(empty)` from the file name making it `mail-config.json`

   _PHPMailer is included (mail/phpMailer) but can be updated with Composer if desired._

3. **Configure Web Server:**  
   Point the document root at the project root. The application is initialized via `index.php` and `core.php`.

4. **Access the Application:**  
   Open `http://localhost:[YOUR CONFIGURED PORT]` or your deployed domain in a browser and you will land on the homepage by default (`views/home.php`).

---

## Usage

- **Professional Presentation:**  
  Edit or add pages and see immediate updates in navigation and UI.
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
├── components/            # Modular UI (card, nav-bar, pop-up, language-toggle)
│   ├── card/
│   ├── language-toggle/
│   ├── nav-bar/
│   │   └── configs/        # page-config.json: nav order/icons
│   └── pop-up/
├── core.php               # App orchestrator/entry-point
├── helpers/               # Util: dynamic discovery, translation, etc.
│   ├── instance-provider.php
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

For insight on how to add pages, languages etc see: [Extending & Customizing](#extending--customizing).

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

### Contact & Validation

- Contact forms use validators in `validators/` and tokenized mail templates in `mail/templates/`.
- Secure mail sending uses the Mailer class build on top of PHPMailer, with credentials externalized in the config (`mail-config.json`).
- Forms are validated on both client and server side.

### User Experience

- Features like active-page highlighting, icons, and pop-ups are configuration-driven.
- Responsive design ensures a seamless user experience across various devices and screen sizes.

---

## Extending & Customizing

- **Add a Page:** Place a `.php` file in `views/` and configure it in `nav-bar/configs/page-config.json`.  
  &rarr; Making sure that the JSON key matches the file name !  
  Add a translation key to all the files under `translations/` in the `SPA_SETUP` section. This is going to be the text used for the navigation.  
  &rarr; Again making sure to match the JSON key with the view-file name !
- **Add a Language:** Put a new `{lang}.json` in `translations/`.
- **Customize Navigation**: Edit `page-config.json` to update order and icons.
- **UI or Validation Extensions**: Write new components (implement the required interface) or validators, and add mail templates as needed.  
  Mail templates use a custom file extension (.tpl) which is basically html with tokens.

---

## License

This project is released under the [MIT License](LICENSE).  
You are free to use, modify, and share under these terms.

---

## Updates

The README is updated regularly to match new features and code changes. If you notice outdated information, rest assured it will be refreshed as soon as possible.

---

**Thank you for your interest in this project! Feel free to contact me with any questions or for technical discussions.**
