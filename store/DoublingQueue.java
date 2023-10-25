// DoublingQueue.java


// Below is the syntax highlighted version of DoublingQueue.java from �4.3 Stacks and Queues.


/*************************************************************************
 *  Compilation:  javac DoublingQueue.java
 *  Execution:    java DoublingQueue
 *
 *  Queue implementation with an array. Resizes by doubling and halving.
 *
 *************************************************************************/

import java.util.Iterator;
import java.util.NoSuchElementException;

// suppress unchecked warnings in Java 1.5.0_6 and later
@SuppressWarnings("unchecked")

public class DoublingQueue<Item> implements Iterable<Item> {
    private Item[] q;            // queue elements
    private int N = 0;           // number of elements on queue
    private int first = 0;       // index of first element of queue
    private int last  = 0;       // index of next available slot

    // cast needed since no generic array creation in Java
    public DoublingQueue() {
        q = (Item[]) new Object[2];
    }

    public boolean isEmpty() { return N == 0;    }
    public int size()        { return N;         }

    // resize the underlying array
    private void resize(int max) {
        assert(max >= N);
        Item[] temp = (Item[]) new Object[max];
        for (int i = 0; i < N; i++) temp[i] = q[(first + i) % q.length];
        q = temp;
        first = 0;
        last  = N;
    }


    public void enqueue(Item item) {
        // double size of array if necessary and recopy to front of array
        if (N == q.length) resize(2*q.length);   // double size of array if necessary
        q[last++] = item;                        // add item
        if (last == q.length) last = 0;          // wrap-around
        N++;
    }

    // remove the least recently added item
    public Item dequeue() {
        if (isEmpty()) throw new RuntimeException("Queue underflow");
        Item item = q[first];
        q[first] = null;                            // to avoid loitering
        N--;
        first++;
        if (first == q.length) first = 0;           // wrap-around
        // shrink size of array if necessary
        if (N > 0 && N == q.length/4) resize(q.length/2);
        return item;
    }

    public Iterator<Item> iterator() { return new QueueIterator(); }

    // an iterator, doesn't implement remove() since it's optional
    private class QueueIterator implements Iterator<Item> {
        private int i = 0;
        public boolean hasNext()  { return i < N;                               }
        public void remove()      { throw new UnsupportedOperationException();  }

        public Item next() {
            if (!hasNext()) throw new NoSuchElementException();
            Item item = q[i];
            i++;
            if (i == q.length) i = 0;     // wrap-around
            return item;
        }
    }



    // a test client
    public static void main(String[] args) {
        DoublingQueue<String> queue = new DoublingQueue<String>();
        queue.enqueue("This");
        queue.enqueue("is");
        queue.enqueue("a");
        queue.enqueue("test.");

        for (String s : queue)
            System.out.println(s);

        System.out.println();

        while (!queue.isEmpty())  {
            System.out.println(queue.dequeue());
        }
    }


}


// Copyright � 2000�2011, Robert Sedgewick and Kevin Wayne.
// Last updated: Wed Feb 9 09:17:30 EST 2011.
