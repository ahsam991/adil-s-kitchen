import { useState } from 'react'
import {
  motion,
  AnimatePresence,
  useReducedMotion,
  useSpring,
  useMotionValue,
} from 'motion/react'

const ITEMS = [
  { id: 1, name: 'Belgian Dream Cake', emoji: '🍰', price: '৳1,450', cat: 'Dream Cake' },
  { id: 2, name: 'Chocolate Birthday Cake', emoji: '🎂', price: '৳1,250', cat: 'Birthday' },
  { id: 3, name: 'Mango Tub Cake', emoji: '🍫', price: '৳950', cat: 'Tub Cake' },
  { id: 4, name: 'Crispy Chicken Burger', emoji: '🍔', price: '৳180', cat: 'Fast Food' },
  { id: 5, name: 'Frosted Cupcakes (6pc)', emoji: '🧁', price: '৳420', cat: 'Cupcakes' },
  { id: 6, name: 'Chicken & Egg Roll', emoji: '🫔', price: '৳140', cat: 'Fast Food' },
]

const listVariants = {
  hidden: { opacity: 0 },
  visible: {
    opacity: 1,
    transition: { staggerChildren: 0.09, delayChildren: 0.1 },
  },
  exit: {
    opacity: 0,
    transition: { when: 'afterChildren', staggerChildren: 0.04, staggerDirection: -1 },
  },
}

const itemVariants = {
  hidden: { opacity: 0, y: 24 },
  visible: { opacity: 1, y: 0, transition: { type: 'spring', stiffness: 320, damping: 26 } },
  exit: { opacity: 0, x: -60, transition: { duration: 0.18 } },
}

function SpringButtons() {
  return (
    <div className="flex gap-3 wrap">
      <motion.button
        className="btn btn-primary"
        whileHover={{ scale: 1.06 }}
        whileTap={{ scale: 0.96 }}
        transition={{ type: 'spring', stiffness: 400, damping: 17 }}
      >
        Order Now
      </motion.button>
      <motion.button
        className="btn btn-tan"
        whileHover={{ scale: 1.06, rotate: -1 }}
        whileTap={{ scale: 0.94 }}
        transition={{ type: 'spring', stiffness: 500, damping: 12 }}
      >
        Custom Cake
      </motion.button>
      <motion.button
        className="btn btn-ghost"
        whileHover={{ y: -3 }}
        whileTap={{ scale: 0.97 }}
        transition={{ type: 'spring', stiffness: 350, damping: 20 }}
      >
        View Menu
      </motion.button>
    </div>
  )
}

function DragBox() {
  return (
    <motion.div
      className="drag-box"
      drag
      dragConstraints={{ left: -110, right: 110, top: -60, bottom: 60 }}
      whileDrag={{ scale: 1.12, boxShadow: '0 18px 40px rgba(106,27,46,.35)' }}
      dragElastic={0.12}
    >
      <span>🍰</span> drag me
    </motion.div>
  )
}

function SpringValueDemo() {
  const reduce = useReducedMotion()
  const x = useSpring(useMotionValue(0), { stiffness: 320, damping: 22 })

  return (
    <div>
      <motion.div
        className="spring-chip"
        style={{ x }}
        onClick={() => (reduce ? x.jump(0) : x.set(x.get() === 0 ? 150 : 0))}
      >
        click to spring me →
      </motion.div>
      <p className="hint">Powered by <code>useSpring</code> — interruptible physics.</p>
    </div>
  )
}

function FormFieldDemo() {
  const [error, setError] = useState(false)

  return (
    <div className="form-wrap">
      <input
        type="text"
        className="field"
        placeholder="Email address"
        value={error ? 'not-an-email' : ''}
        readOnly
        onClick={() => setError((e) => !e)}
        style={{ borderColor: error ? '#d0342c' : '#d8c8b8' }}
      />
      <AnimatePresence>
        {error && (
          <motion.p
            className="field-error"
            initial={{ opacity: 0, y: -6, height: 0 }}
            animate={{ opacity: 1, y: 0, height: 'auto' }}
            exit={{ opacity: 0, y: -6, height: 0 }}
            transition={{ duration: 0.18 }}
          >
            Please enter a valid email address
          </motion.p>
        )}
      </AnimatePresence>
      <button className="btn btn-primary small" onClick={() => setError((e) => !e)}>
        {error ? 'Reset field' : 'Submit (invalid)'}
      </button>
    </div>
  )
}

export default function App() {
  const [cart, setCart] = useState([])
  const [selected, setSelected] = useState(null)
  const reduce = useReducedMotion()

  const toggleItem = (id) =>
    setCart((prev) => (prev.includes(id) ? prev.filter((i) => i !== id) : [...prev, id]))

  const openItem = (id) => setSelected(ITEMS.find((i) => i.id === id))
  const closeItem = () => setSelected(null)

  return (
    <div className="page">
      <header className="hero">
        <motion.h1
          initial={{ opacity: 0, y: -26 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ type: 'spring', stiffness: 260, damping: 24 }}
        >
          Motion <span>Playground</span>
        </motion.h1>
        <motion.p
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ delay: 0.25, duration: 0.4 }}
        >
          Variants · AnimatePresence · Springs · layoutId · drag — built with{' '}
          <code>motion/react</code> (the modern successor to framer-motion)
        </motion.p>
        {reduce && <p className="notice">Reduced motion detected — springs &amp; reveals are tamed.</p>}
      </header>

      <section>
        <h2>1 · Spring buttons</h2>
        <SpringButtons />
      </section>

      <section>
        <h2>2 · Variants + stagger + AnimatePresence exit</h2>
        <p className="hint">Add a treat to the cart, then remove it — watch the list re-stagger.</p>
        <motion.ul
          className="list"
          variants={listVariants}
          initial="hidden"
          animate="visible"
          exit="exit"
        >
          <AnimatePresence>
            {ITEMS.map((item) => (
              <motion.li
                key={item.id}
                layout
                variants={itemVariants}
                whileHover={{ x: 6 }}
                className="list-item"
                onClick={() => toggleItem(item.id)}
              >
                <span className="emoji">{item.emoji}</span>
                <div className="grow">
                  <strong>{item.name}</strong>
                  <small>{item.cat}</small>
                </div>
                <span className="price">{item.price}</span>
                <span className={`pill ${cart.includes(item.id) ? 'on' : ''}`}>
                  {cart.includes(item.id) ? '✓ In cart' : 'Tap to add'}
                </span>
              </motion.li>
            ))}
          </AnimatePresence>
        </motion.ul>
      </section>

      <section>
        <h2>3 · layoutId — shared element modal</h2>
        <p className="hint">Click a card; the image flies into the modal and back.</p>
        <div className="grid">
          {ITEMS.map((item) => (
            <motion.button
              key={item.id}
              className="card"
              onClick={() => openItem(item.id)}
              whileHover={{ y: -6 }}
              whileTap={{ scale: 0.97 }}
            >
              <motion.div layoutId={`img-${item.id}`} className="thumb">
                {item.emoji}
              </motion.div>
              <strong>{item.name}</strong>
              <small>{item.price}</small>
            </motion.button>
          ))}
        </div>

        <AnimatePresence>
          {selected && (
            <motion.div
              className="backdrop"
              initial={{ opacity: 0 }}
              animate={{ opacity: 1 }}
              exit={{ opacity: 0 }}
              onClick={closeItem}
            >
              <motion.div
                className="modal"
                layoutId={`img-${selected.id}`}
                onClick={(e) => e.stopPropagation()}
                transition={{ type: 'spring', stiffness: 300, damping: 26 }}
              >
                <div className="modal-emoji">{selected.emoji}</div>
                <h3>{selected.name}</h3>
                <p>{selected.cat} — {selected.price}</p>
                <button className="btn btn-tan small" onClick={closeItem}>
                  Close
                </button>
              </motion.div>
            </motion.div>
          )}
        </AnimatePresence>
      </section>

      <section>
        <h2>4 · Scroll reveal + drag + spring values</h2>
        <motion.div
          initial={reduce ? { opacity: 0 } : { opacity: 0, y: 60 }}
          whileInView={reduce ? { opacity: 1 } : { opacity: 1, y: 0 }}
          viewport={{ once: true, amount: 0.5 }}
          transition={{ type: 'spring', stiffness: 220, damping: 26 }}
          className="reveal"
        >
          I reveal when 50% visible — once.
        </motion.div>
        <div className="flex gap-3 wrap items-center">
          <DragBox />
          <SpringValueDemo />
        </div>
      </section>

      <section>
        <h2>5 · Animated form feedback</h2>
        <FormFieldDemo />
      </section>

      <footer className="foot">
        Tip: press <kbd>Ctrl/Cmd</kbd>+<kbd>Shift</kbd>+<kbd>P</kbd> → "Rendering" → emulate
        <em> prefers-reduced-motion</em> to see the reduced-motion branches.
      </footer>
    </div>
  )
}
