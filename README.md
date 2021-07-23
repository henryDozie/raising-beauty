# Raising Beauty

This is the code base for on of my past projects (www.raisingbeauty.com) I have excluded the media files since they will take up too much needless space. This is a custom site that was developed in WordPress.

## Assumptions

* WordPress as a Git submodule in `/wp/`
* Custom content directory in `/content/` (cleaner, and also because it can't be in `/wp/`)
* `wp-config.php` in the root (because it can't be in `/wp/`)
* All writable directories are symlinked to similarly named locations under `/shared/`. which is .gitignored

#### Brief Visualization

![Landing Page](./RB.gif)

## Questions & Answers

**Q:** What version of WordPress does this track?  
**A:** The latest stable release. Send a pull request if I fall behind.

**Q:** What's the deal with `local-config.php`?  
**A:** It is for local development, which might have different MySQL credentials or do things like enable query saving or debug mode. This file is ignored by Git, so it doesn't accidentally get checked in. If the file does not exist (which it shouldn't, in production), then WordPress will use the DB credentials defined in `wp-config.php`.

### Please note that you can find the customizations in ./content/themes/genesis-sample
