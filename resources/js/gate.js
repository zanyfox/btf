export default class Gate {

  constructor(user) {
    this.user = user
  }

  isAdmin() {
    return this.user.is_admin === 1 // this.user.role === 'admin'
  }

  isNotAdmin() {
    return this.user.is_admin ==! 1 // this.user.role === 'admin'
  }

  can(permission) {
    return true
  }
}
