# Git Guide

A quick reference guide for commonly used Git commands.

## Configuration

```bash
# Set your name and email
git config --global user.name "Your Name"
git config --global user.email "your.email@example.com"

# View configuration
git config --list
```

## Getting Started

```bash
# Initialize a new repository
git init

# Clone an existing repository
git clone <repository-url>
git clone <repository-url> <directory-name>
```

## Basic Commands

### Checking Status

```bash
# Check repository status
git status

# Check status in short format
git status -s
```

### Staging Changes

```bash
# Stage a specific file
git add <filename>

# Stage all changes
git add .

# Stage all changes including deletions
git add -A

# Unstage a file
git reset <filename>
```

### Committing

```bash
# Commit with message
git commit -m "Your commit message"

# Commit all tracked changes
git commit -am "Your commit message"

# Amend the last commit
git commit --amend -m "New commit message"
```

### Viewing History

```bash
# View commit history
git log

# View compact history
git log --oneline

# View history with graph
git log --oneline --graph --all

# View last n commits
git log -n 5
```

## Branching

```bash
# List all branches
git branch

# List all branches (including remote)
git branch -a

# Create a new branch
git branch <branch-name>

# Switch to a branch
git checkout <branch-name>

# Create and switch to a new branch
git checkout -b <branch-name>

# Delete a branch
git branch -d <branch-name>

# Force delete a branch
git branch -D <branch-name>
```

## Merging

```bash
# Merge a branch into current branch
git merge <branch-name>

# Abort a merge
git merge --abort
```

## Remote Repositories

```bash
# View remote repositories
git remote -v

# Add a remote repository
git remote add origin <repository-url>

# Remove a remote
git remote remove <name>

# Fetch changes from remote
git fetch origin

# Pull changes from remote
git pull origin <branch-name>

# Push changes to remote
git push origin <branch-name>

# Push and set upstream
git push -u origin <branch-name>
```

## Undoing Changes

```bash
# Discard changes in working directory
git checkout -- <filename>

# Discard all changes
git checkout -- .

# Reset to a specific commit (keep changes staged)
git reset --soft <commit-hash>

# Reset to a specific commit (keep changes unstaged)
git reset --mixed <commit-hash>

# Reset to a specific commit (discard all changes)
git reset --hard <commit-hash>

# Revert a commit (creates new commit)
git revert <commit-hash>
```

## Stashing

```bash
# Stash current changes
git stash

# Stash with a message
git stash save "Your message"

# List all stashes
git stash list

# Apply most recent stash
git stash apply

# Apply and remove most recent stash
git stash pop

# Apply a specific stash
git stash apply stash@{n}

# Drop a stash
git stash drop stash@{n}

# Clear all stashes
git stash clear
```

## Viewing Differences

```bash
# View unstaged changes
git diff

# View staged changes
git diff --staged

# View changes between commits
git diff <commit1> <commit2>

# View changes between branches
git diff <branch1> <branch2>
```

## Tags

```bash
# List tags
git tag

# Create a lightweight tag
git tag <tag-name>

# Create an annotated tag
git tag -a <tag-name> -m "Tag message"

# Push tags to remote
git push origin --tags

# Delete a local tag
git tag -d <tag-name>

# Delete a remote tag
git push origin --delete <tag-name>
```

## Useful Tips

### Aliases

```bash
# Create shortcuts for common commands
git config --global alias.co checkout
git config --global alias.br branch
git config --global alias.ci commit
git config --global alias.st status
```

### .gitignore

Create a `.gitignore` file to exclude files from tracking:

```
# Dependencies
node_modules/
vendor/

# Environment files
.env
.env.local

# IDE files
.idea/
.vscode/

# OS files
.DS_Store
Thumbs.db

# Build files
dist/
build/

# Logs
*.log
```

### Common Workflows

**Feature Branch Workflow:**
```bash
# 1. Create feature branch
git checkout -b feature/new-feature

# 2. Make changes and commit
git add .
git commit -m "Add new feature"

# 3. Push to remote
git push -u origin feature/new-feature

# 4. Create pull request on GitHub/GitLab

# 5. After merge, clean up
git checkout main
git pull origin main
git branch -d feature/new-feature
```

**Sync with Main Branch:**
```bash
# Update your feature branch with latest main
git checkout main
git pull origin main
git checkout feature/your-feature
git merge main
```

## Quick Reference

| Command | Description |
|---------|-------------|
| `git init` | Initialize repository |
| `git clone <url>` | Clone repository |
| `git add .` | Stage all changes |
| `git commit -m "msg"` | Commit changes |
| `git push` | Push to remote |
| `git pull` | Pull from remote |
| `git branch` | List branches |
| `git checkout -b <name>` | Create & switch branch |
| `git merge <branch>` | Merge branch |
| `git stash` | Stash changes |
| `git log --oneline` | View history |
| `git status` | Check status |
